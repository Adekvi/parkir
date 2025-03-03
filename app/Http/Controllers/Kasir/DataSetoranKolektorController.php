<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Parker;
use App\Models\RekapParkir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataSetoranKolektorController extends Controller
{
    public function index()
    {
        // Ambil semua ID dari pengguna dengan role kolektor
        $kolektorIds = User::where('role', 'kolektor')->pluck('id');

        // Ambil data berdasarkan id_kolektor yang sesuai, dan hitung totalnya
        $terima = RekapParkir::whereIn('id_kolektor', $kolektorIds)
            ->with('user') // Relasi ke model User
            ->get()
            ->groupBy('id_kolektor') // Kelompokkan berdasarkan id_kolektor
            ->map(function ($items) {
                // Hitung total jumlah dan nilai per kolektor
                return [
                    'id_kolektor' => $items->first()->id_kolektor, // ID Kolektor
                    'namaLengkap' => $items->first()->user->namaLengkap ?? 'Tidak Diketahui', // Nama Kolektor
                    'data' => $items, // Data semua transaksi kolektor ini
                    'jumlahMotor' => $items->sum('jumlahMotor'),
                    'jumlahMobil' => $items->sum('jumlahMobil'),
                    'nilaiMotor' => $items->sum('nilaiMotor'),
                    'nilaiMobil' => $items->sum('nilaiMobil'),
                    'total' => $items->sum('total'),
                    'created_at' => $items->pluck('created_at')->map(function ($date) {
                        return \Carbon\Carbon::parse($date)->timezone('Asia/Jakarta')->format('d:m:Y / H:i');
                    }), // Tanggal dalam format yang diinginkan
                    'status' => 'Kolektor',
                ];
            });

        // dd($terima);

        // Ambil data dari tabel Parker, dengan pengelompokan berdasarkan id_lokasiParkir
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

            // dd($parker);

        // Kirim data ke view
        return view('kasir.terima.index', compact('terima', 'parker'));
    }

    public function terima(Request $request, $id_kolektor)
    {
        // Mengupdate status menjadi diterima untuk semua data dengan id_kolektor yang sama
        $data = RekapParkir::where('id_kolektor', $id_kolektor)
                    ->update([
                        'status' => 'Kasir', // Status diubah menjadi diterima (1)
                        'updated_at' => now()  // Menambahkan tanggal update
                    ]);

        // dd($data);

        // Mengecek apakah ada data yang diupdate
        if ($data) {
            return redirect()->route('kasir.dataSetoran')->with('success', 'Status data Setoran berhasil diterima');
        } else {
            return redirect()->route('kasir.dataSetoran')->with('error', 'Tidak ada data yang diperbarui');
        }
    }

}
