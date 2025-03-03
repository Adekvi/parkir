<?php

namespace App\Http\Controllers\Kasir\Report\Bulanan;

use App\Http\Controllers\Controller;
use App\Models\Parker;
use App\Models\RekapParkir;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BulananController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua ID dari pengguna dengan role kolektor
        $kolektorIds = User::where('role', 'kolektor')->pluck('id');
    
        // Ambil bulan dan tahun dari request
        $bulan = $request->input('bulan') ? Carbon::parse($request->input('bulan'))->format('m') : null;
        $tahun = $request->input('bulan') ? Carbon::parse($request->input('bulan'))->format('Y') : null;
    
        // Ambil data berdasarkan id_kolektor yang sesuai, dan hitung totalnya
        $terima = RekapParkir::whereIn('id_kolektor', $kolektorIds)
            ->with('user', 'shift', 'jam') // Relasi ke model User
            ->when($bulan && $tahun, function ($query) use ($bulan, $tahun) {
                return $query->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
            })
            ->get()
            ->groupBy('id_kolektor') // Kelompokkan berdasarkan id_kolektor
            ->map(function ($items) {
                // Hitung total jumlah dan nilai per kolektor
                return [
                    'id_kolektor' => $items->first()->id_kolektor, // ID Kolektor
                    'namaLengkap' => $items->first()->user->namaLengkap ?? 'Tidak Diketahui', // Nama Kolektor
                    'id_user' => $items->first()->user->namaLengkap,
                    'id_shift' => $items->first()->shift->namaShift,
                    'id_lokasiParkir' => $items->first()->user->id_lokasiParkir,
                    'data' => $items, // Data semua transaksi kolektor ini
                    'jumlahMotor' => $items->sum('jumlahMotor'),
                    'jumlahMobil' => $items->sum('jumlahMobil'),
                    'nilaiMotor' => $items->sum('nilaiMotor'),
                    'nilaiMobil' => $items->sum('nilaiMobil'),
                    'totalKendaraan' => $items->sum('jumlahMotor') + $items->sum('jumlahMobil'),
                    'total' => $items->sum('total'),
                    'created_at' => $items->pluck('created_at')->unique()->map(function ($date) {
                        return \Carbon\Carbon::parse($date)->timezone('Asia/Jakarta')->format('d-m-Y');
                    }),
                    'status' => 'Kolektor',
                ];
            });
    
        // Ambil data dari tabel Parker, dengan pengelompokan berdasarkan id_lokasiParkir
        $parker = Parker::selectRaw('
                id_lokasiParkir,
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
            ->when($bulan && $tahun, function ($query) use ($bulan, $tahun) {
                return $query->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
            })
            ->groupBy('id_lokasiParkir', 'id_shift', 'id_user')
            ->orderBy('id_lokasiParkir', 'asc')
            ->get();
    
        // Return view dengan data yang difilter
        return view('kasir.report.bulanan.index', compact('terima', 'parker'));
    }
}
