<?php

namespace App\Http\Controllers\Kasir\Report\Kolektor;

use App\Http\Controllers\Controller;
use App\Models\Parker;
use App\Models\RekapParkir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KolektorController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter filter dari request
        $idUser = $request->input('id_user');
        $tanggal = $request->input('tanggal'); // Format diharapkan: 'YYYY-MM-DD'

        // Ambil semua ID dari pengguna dengan role kolektor
        $kolektorIds = User::where('role', 'kolektor')->pluck('id');

        // Ambil data berdasarkan id_kolektor dan filter tambahan
        $terimaQuery = RekapParkir::whereIn('id_kolektor', $kolektorIds)
            ->with('user', 'shift', 'jam');

        // dd($terimaQuery);

        // Filter berdasarkan id_user (nama kolektor)
        if ($idUser) {
            $terimaQuery->where('id_kolektor', $idUser);
        }

        // Filter berdasarkan tanggal (created_at)
        if ($tanggal) {
            $terimaQuery->whereDate('created_at', $tanggal);
        }

        // Kelompokkan dan hitung data
        $terima = $terimaQuery->get()
            ->groupBy('id_kolektor')
            ->map(function ($items) {
                return [
                    'id_kolektor' => $items->first()->id_kolektor,
                    'namaLengkap' => $items->first()->user->namaLengkap ?? 'Tidak Diketahui',
                    'id_shift' => $items->first()->user->id_shift,
                    'id_lokasiParkir' => $items->first()->user->id_lokasiParkir,
                    'data' => $items,
                    'jumlahMotor' => $items->sum('jumlahMotor'),
                    'jumlahMobil' => $items->sum('jumlahMobil'),
                    'nilaiMotor' => $items->sum('nilaiMotor'),
                    'nilaiMobil' => $items->sum('nilaiMobil'),
                    'totalKendaraan' => $items->sum('jumlahMotor') + $items->sum('jumlahMobil'),
                    'total' => $items->sum('total'),
                    'created_at' => $items->pluck('created_at')->map(function ($date) {
                        return \Carbon\Carbon::parse($date)->timezone('Asia/Jakarta')->format('d-m-Y');
                    }),
                    'status' => 'Kolektor',
                ];
            });

            // dd($terima);

        $parker = Parker::selectRaw('
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
        ->with(['shift', 'user', 'jam']) // Pastikan relasi shift dan user sudah ada di model
        ->groupBy('id_lokasiParkir', 'id_shift', 'id_user', DB::raw('DATE(created_at)'))
        ->orderBy('id_lokasiParkir', 'asc') // Urutkan berdasarkan id_lokasiParkir
        ->get();            

        return view('kasir.report.kolektor.index', compact('terima', 'parker'));
    }

    public function getLokasiByUser(Request $request)
    {
        $userId = $request->input('id_user');

        // Dapatkan lokasi parkir berdasarkan id_user
        $tanggalBuat = User::where('id', $userId)
            ->get();

        return response()->json($tanggalBuat);
    }

    // public function index(){

    //     // Ambil semua ID dari pengguna dengan role kolektor
    //     $kolektorIds = User::where('role', 'kolektor')->pluck('id');

    //     // Ambil data berdasarkan id_kolektor yang sesuai, dan hitung totalnya
    //     $terima = RekapParkir::whereIn('id_kolektor', $kolektorIds)
    //         ->with('user', 'shift', 'jam') // Relasi ke model User
    //         ->get()
    //         ->groupBy('id_kolektor') // Kelompokkan berdasarkan id_kolektor
    //         ->map(function ($items) {
    //             // Hitung total jumlah dan nilai per kolektor
    //             return [
    //                 'id_kolektor' => $items->first()->id_kolektor, // ID Kolektor
    //                 'namaLengkap' => $items->first()->user->namaLengkap ?? 'Tidak Diketahui', // Nama Kolektor
    //                 'id_user' => $items->first()->user->namaLengkap,                    'id_shift' => $items->first()->user->id_shift,
    //                 'id_lokasiParkir' => $items->first()->user->id_lokasiParkir,
    //                 'data' => $items, // Data semua transaksi kolektor ini
    //                 'jumlahMotor' => $items->sum('jumlahMotor'),
    //                 'jumlahMobil' => $items->sum('jumlahMobil'),
    //                 'nilaiMotor' => $items->sum('nilaiMotor'),
    //                 'nilaiMobil' => $items->sum('nilaiMobil'),
    //                 'totalKendaraan' => $items->sum('jumlahMotor') + $items->sum('jumlahMobil'),
    //                 'total' => $items->sum('total'),
    //                 'created_at' => $items->pluck('created_at')->map(function ($date) {
    //                     return \Carbon\Carbon::parse($date)->timezone('Asia/Jakarta')->format('d:m:Y');
    //                 }), // Tanggal dalam format yang diinginkan
    //                 'status' => 'Kolektor',
    //             ];
    //         });

    //     // dd($terima);

    //     // Ambil data dari tabel Parker, dengan pengelompokan berdasarkan id_lokasiParkir
    //     $parker = Parker::selectRaw('
    //             id_lokasiParkir,
    //             GROUP_CONCAT(nopol SEPARATOR ", ") as nopol_list,
    //             SUM(penerimaan) as total_nominal, -- Total semua penerimaan
    //             SUM(CASE WHEN jenisKendaraan = 1 THEN penerimaan ELSE 0 END) as nilaiMotor, -- Total penerimaan motor
    //             SUM(CASE WHEN jenisKendaraan = 2 THEN penerimaan ELSE 0 END) as nilaiMobil, -- Total penerimaan mobil
    //             SUM(CASE WHEN jenisKendaraan = 1 THEN 1 ELSE 0 END) as jumlahMotor, -- Jumlah motor
    //             SUM(CASE WHEN jenisKendaraan = 2 THEN 1 ELSE 0 END) as jumlahMobil, -- Jumlah mobil
    //             COUNT(*) as totalKendaraan, -- Total semua kendaraan
    //             id_shift,
    //             id_user
    //         ')
    //         ->with(['shift', 'user', 'jam']) // Pastikan relasi shift dan user sudah ada di model
    //         ->groupBy('id_lokasiParkir', 'id_shift', 'id_user') // Kelompokkan berdasarkan lokasiParkir, shift, dan user
    //         ->orderBy('id_lokasiParkir', 'asc') // Urutkan berdasarkan id_lokasiParkir
    //         ->get();

    //         // dd($parker);

    //     return view('kasir.report.kolektor.index', compact('terima', 'parker'));
    // }
}
