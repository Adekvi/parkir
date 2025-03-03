<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\Jalan;
use App\Models\Parker;
use Illuminate\Http\Request;

class DalanController extends Controller
{
    public function index(Request $request)
    {

        $namaJalan = Jalan::select('id', 'namaJalan')->get();

        // Parameter yang diambil dari request
        $id_jalan = $request->input('id_jalan'); // Nama jalan yang dipilih
        $tanggal = $request->input('tanggal'); // Format diharapkan: 'YYYY-MM-DD'

        $jalan = Parker::selectRaw('
            id_lokasiParkir,
            DATE(created_at) as tanggal,
            GROUP_CONCAT(nopol SEPARATOR ", ") as nopol_list,
            SUM(penerimaan) as total_nominal,
            SUM(CASE WHEN jenisKendaraan = 1 THEN penerimaan ELSE 0 END) as nilaiMotor,
            SUM(CASE WHEN jenisKendaraan = 2 THEN penerimaan ELSE 0 END) as nilaiMobil,
            SUM(CASE WHEN jenisKendaraan = 1 THEN 1 ELSE 0 END) as jumlahMotor,
            SUM(CASE WHEN jenisKendaraan = 2 THEN 1 ELSE 0 END) as jumlahMobil,
            COUNT(*) as totalKendaraan,
            id_shift,
            id_user
        ')
        ->with(['shift', 'user', 'jam']) // Pastikan relasi shift dan user sudah ada di model
        ->when($id_jalan, function ($query, $id_jalan) {
            // Filter berdasarkan nama jalan (relasi dengan tabel 'Jalan')
            return $query->whereHas('lokasiParkir', function ($lokasiQuery) use ($id_jalan) {
                $lokasiQuery->where('id_jalan', $id_jalan);
            });
        })
        ->when($tanggal, function ($query, $tanggal) {
            // Filter berdasarkan tanggal
            return $query->whereDate('created_at', $tanggal);
        })
        ->groupBy('id_lokasiParkir', 'id_shift', 'id_user', 'tanggal')
        ->orderBy('id_lokasiParkir', 'asc')
        ->get();

        // dd($jalan);

        return view('admin.report.dalan.index',compact('namaJalan', 'jalan'));
    }
}
