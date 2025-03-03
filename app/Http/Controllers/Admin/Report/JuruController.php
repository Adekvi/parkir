<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\JamLokasi;
use App\Models\Parker;
use App\Models\User;
use Illuminate\Http\Request;

class JuruController extends Controller
{
    public function index(Request $request)
    {
        // Ambil daftar user dan lokasi parkir untuk filter
        $users = User::where('role', 'user')->get();
        // dd($users);
        $lokasiParkir = JamLokasi::all(); // Ambil semua lokasi parkir

        // Query utama untuk mengambil data juru parkir
        $juru = Parker::selectRaw('
                id_lokasiParkir,
                DATE(created_at) as tanggal, -- Ambil tanggal dari created_at,
                GROUP_CONCAT(nopol SEPARATOR ", ") as nopol_list,
                SUM(penerimaan) as total_nominal, -- Total semua penerimaan
                SUM(CASE WHEN jenisKendaraan = "Motor" THEN penerimaan ELSE 0 END) as motor, -- Total penerimaan motor
                SUM(CASE WHEN jenisKendaraan = "Mobil" THEN penerimaan ELSE 0 END) as mobil, -- Total penerimaan mobil
                SUM(CASE WHEN jenisKendaraan = "Motor" THEN 1 ELSE 0 END) as jumlahMotor, -- Jumlah motor
                SUM(CASE WHEN jenisKendaraan = "Mobil" THEN 1 ELSE 0 END) as jumlahMobil, -- Jumlah mobil
                COUNT(*) as totalKendaraan, -- Total semua kendaraan
                id_shift,
                id_user
            ')
            ->with(['shift', 'user', 'jam']) // Pastikan relasi shift dan user sudah ada di model
            // ->when($request->id, function ($query, $id) {
            //     return $query->where('id', $id);
            // })
            ->when($request->id_user, function ($query, $id_user) {
                // Filter berdasarkan user
                return $query->where('id_user', $id_user);
            })
            ->when($request->id_lokasiParkir, function ($query, $id_lokasiParkir) {
                // Filter berdasarkan lokasi parkir
                return $query->where('id_lokasiParkir', $id_lokasiParkir);
            })
            ->groupBy('id_lokasiParkir', 'id_shift', 'id_user', 'tanggal')
            ->orderBy('id_lokasiParkir', 'asc')
            ->get();

        // $coba = User::where('role', ['user', 'kolektor'])->with('jam')->get();
        // dd($juru);

        // Tampilkan hasil ke view
        return view('admin.report.juru.index', compact('juru', 'users', 'lokasiParkir'));
    }

    public function getLokasi(Request $request)
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
