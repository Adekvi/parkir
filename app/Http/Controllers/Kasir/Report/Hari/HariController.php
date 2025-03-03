<?php

namespace App\Http\Controllers\Kasir\Report\Hari;

use App\Http\Controllers\Controller;
use App\Models\Parker;
use App\Models\RekapParkir;
use App\Models\User;
use Illuminate\Http\Request;

class HariController extends Controller
{
    public function index(){

        // Ambil semua ID dari pengguna dengan role kolektor
        $kolektorIds = User::where('role', 'kolektor')->pluck('id');

        // Ambil data berdasarkan id_kolektor yang sesuai, dan hitung totalnya
        $terima = RekapParkir::whereIn('id_kolektor', $kolektorIds)
            ->with('user', 'shift', 'jam') // Relasi ke model User
            ->get()
            ->groupBy('id_kolektor') // Kelompokkan berdasarkan id_kolektor
            ->map(function ($items) {
                // Hitung total jumlah dan nilai per kolektor
                return [
                    'id_kolektor' => $items->first()->id_kolektor, // ID Kolektor
                    'namaLengkap' => $items->first()->user->namaLengkap ?? 'Tidak Diketahui', // Nama Kolektor
                    'id_user' => $items->first()->user->namaLengkap,                    'id_shift' => $items->first()->shift->namaShift,
                    'id_lokasiParkir' => $items->first()->user->id_lokasiParkir,
                    'data' => $items, // Data semua transaksi kolektor ini
                    'jumlahMotor' => $items->sum('jumlahMotor'),
                    'jumlahMobil' => $items->sum('jumlahMobil'),
                    'nilaiMotor' => $items->sum('nilaiMotor'),
                    'nilaiMobil' => $items->sum('nilaiMobil'),
                    'totalKendaraan' => $items->sum('jumlahMotor') + $items->sum('jumlahMobil'),
                    'total' => $items->sum('total'),
                    'created_at' => $items->pluck('created_at')->map(function ($date) {
                        return \Carbon\Carbon::parse($date)->timezone('Asia/Jakarta')->format('d:m:Y');
                    }), // Tanggal dalam format yang diinginkan
                    'status' => 'Kolektor',
                ];
            });

        // dd($terima);

        // Ambil data dari tabel Parker, dengan pengelompokan berdasarkan id_lokasiParkir
        $parker = Parker::selectRaw('
                id_lokasiParkir,
                GROUP_CONCAT(nopol SEPARATOR ", ") as nopol_list,
                SUM(penerimaan) as total_nominal, -- Total semua penerimaan
                SUM(CASE WHEN jenisKendaraan = 1 THEN penerimaan ELSE 0 END) as nilaiMotor, -- Total penerimaan motor
                SUM(CASE WHEN jenisKendaraan = 2 THEN penerimaan ELSE 0 END) as nilaiMobil, -- Total penerimaan mobil
                SUM(CASE WHEN jenisKendaraan = 1 THEN 1 ELSE 0 END) as jumlahMotor, -- Jumlah motor
                SUM(CASE WHEN jenisKendaraan = 2 THEN 1 ELSE 0 END) as jumlahMobil, -- Jumlah mobil
                COUNT(*) as totalKendaraan, -- Total semua kendaraan
                id_shift,
                id_user
            ')
            ->with(['shift', 'user', 'jam']) // Pastikan relasi shift dan user sudah ada di model
            ->groupBy('id_lokasiParkir', 'id_shift', 'id_user') // Kelompokkan berdasarkan lokasiParkir, shift, dan user
            ->orderBy('id_lokasiParkir', 'asc') // Urutkan berdasarkan id_lokasiParkir
            ->get();

            // dd($parker);

        return view('kasir.report.harian.index', compact('terima', 'parker'));
    }

}
