<?php

namespace App\Http\Controllers\Kasir\Report\Juru;

use App\Http\Controllers\Controller;
use App\Models\JamLokasi;
use App\Models\Parker;
use App\Models\RekapParkir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JuruParkirController extends Controller
{
    public function index(Request $request)
    {
        // Ambil daftar user dan lokasi parkir untuk filter
        $users = User::where('role', 'user')->get();
        $lokasiParkir = JamLokasi::all(); // Ambil semua lokasi parkir

        // Query utama untuk mengambil data juru parkir sesuai `id_user`
        $juru = Parker::selectRaw('
                id_lokasiParkir,
                DATE(created_at) as tanggal,
                GROUP_CONCAT(nopol SEPARATOR ", ") as nopol_list,
                SUM(penerimaan) as total_nominal,
                SUM(CASE WHEN jenisKendaraan = "Motor" THEN penerimaan ELSE 0 END) as nilaiMotor,
                SUM(CASE WHEN jenisKendaraan = "Mobil" THEN penerimaan ELSE 0 END) as nilaiMobil,
                SUM(CASE WHEN jenisKendaraan = "Motor" THEN 1 ELSE 0 END) as jumlahMotor,
                SUM(CASE WHEN jenisKendaraan = "Mobil" THEN 1 ELSE 0 END) as jumlahMobil,
                COUNT(*) as totalKendaraan,
                id_shift,
                id_user
            ')
            ->with(['shift', 'user', 'jam']) // Relasi untuk shift, user, dan lokasi parkir
            ->when($request->id_user, function ($query, $id_user) {
                return $query->where('id_user', $id_user);
            })
            ->groupBy('id_lokasiParkir', 'id_shift', 'id_user', DB::raw('DATE(created_at)'))
            ->orderBy('id_lokasiParkir', 'asc')
            ->get();

        // Return view dengan data sesuai filter
        return view('kasir.report.juruParkir.index', compact('juru', 'users', 'lokasiParkir'));
    }

    public function getLokasiByUser(Request $request)
    {
        $userId = $request->input('id_user');

        // Dapatkan lokasi parkir berdasarkan id_user
        $lokasiParkir = User::where('id', $userId)
            ->with('jam') // Pastikan relasi `lokasiParkir` ada di model User
            ->get()
            ->pluck('jam')
            ->flatten();

        return response()->json($lokasiParkir);
    }

}
