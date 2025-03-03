<?php

namespace App\Http\Controllers\Kolektor;

use App\Http\Controllers\Controller;
use App\Models\Ket;
use App\Models\Parker;
use App\Models\RekapParkir;
use App\Models\Setor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetorController extends Controller
{
    public function disetor()
    {
        $user = User::where('role', 'user')->first(); // Ambil pengguna pertama

        if ($user) {
            $idShift = $user->id_shift; // Ambil id_shift langsung dari model
        } else {
            $idShift = null; // Jika tidak ada pengguna dengan role 'user'
        }

        // dd($idShift);

        $setor = Parker::selectRaw('
                GROUP_CONCAT(nopol SEPARATOR ", ") as nopol_list,
                SUM(penerimaan) as total_nominal,
                status,
                id_shift,
                id_user
            ')
            ->with('shift', 'user')
            ->where('status', 'Sudah disetor') // Filter hanya data "Belum disetor"
            ->groupBy('id_shift', 'id_user', 'status') // Grupkan berdasarkan id_shift dan status
            ->orderBy('id', 'asc') // Urutkan berdasarkan status
            ->get();
        
        // dd($setor);
        
        $bayar = Parker::selectRaw('
                id_lokasiParkir,
                GROUP_CONCAT(nopol SEPARATOR ", ") as nopol_list,
                SUM(penerimaan) as total_nominal, -- Total semua penerimaan
                SUM(CASE WHEN jenisKendaraan = 1 THEN penerimaan ELSE 0 END) as nilaiMotor, -- Total penerimaan motor
                SUM(CASE WHEN jenisKendaraan = 2 THEN penerimaan ELSE 0 END) as nilaiMobil, -- Total penerimaan mobil
                SUM(CASE WHEN jenisKendaraan = 1 THEN 1 ELSE 0 END) as jumlahMotor, -- Jumlah motor
                SUM(CASE WHEN jenisKendaraan = 2 THEN 1 ELSE 0 END) as jumlahMobil, -- Jumlah mobil
                COUNT(*) as totalKendaraan, -- Total semua kendaraan
                status,
                id_shift,
                id_user
            ')
            ->with(['shift', 'user', 'jam'])
            ->where('status', 'Sudah disetor')
            ->groupBy('id_lokasiParkir', 'id_shift', 'id_user', 'status') // Kelompokkan berdasarkan lokasiParkir, shift, dan user
            ->orderBy('id_lokasiParkir', 'asc') // Urutkan berdasarkan id_lokasiParkir
            ->get();

        // dd($bayar);

        return view('kolektor.disetor.index', compact('user', 'setor', 'bayar', 'idShift'));
    }
}
