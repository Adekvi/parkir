<?php

namespace App\Http\Controllers\Kolektor;

use App\Http\Controllers\Controller;
use App\Models\Ket;
use App\Models\Parker;
use App\Models\RekapParkir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
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
            ->with('shift', 'user.jam') // Pastikan relasi shift dan user sudah ada di model
            ->where('status', 'Belum disetor') // Filter hanya data "Belum disetor"
            ->groupBy('id_shift', 'id_user', 'status') // Grupkan berdasarkan id_shift, id_user, dan status
            ->orderBy('id', 'asc') // Urutkan berdasarkan id
            ->get();
        
        // dd($setor);
        
        $bayar = Parker::where('status', 'Sudah disetor')
            ->Orwhere('status', 'Belum disetor')
            ->orderBy('id', 'asc')
            ->get();

        $ket = Ket::all();
        // dd($bayar);

        return view('kolektor.setor.index', compact('user', 'setor', 'bayar', 'idShift', 'ket'));
    }

    public function setoran(Request $request) {
        // dd($request->all());
    
        $dataParkir = Parker::where('id_lokasiParkir', $request->id_lokasiParkir)
            ->where('status', 'Belum disetor')
            ->get();
    
        $data = Parker::where('id_lokasiParkir', $request->id_lokasiParkir)
            ->update(['status' => 'Sudah disetor']);
    
        // Data yang diterima dari form
        $dataPost = $request->data; // Ini akan menjadi array yang berisi semua data yang dikirimkan
    
        // Melakukan perhitungan dan penyimpanan data rekap
        $totalMotor = 0;
        $totalMobil = 0;
        $nilaiMotor = 0;
        $nilaiMobil = 0;
        $total = 0;
    
        foreach ($dataPost as $item) {
            $totalMotor += $item['totalMotor'];
            $totalMobil += $item['totalMobil'];
            $nilaiMotor += $item['nilaiMotor'];
            $nilaiMobil += $item['nilaiMobil'];
            $total += $item['total'];
        }
    
        // Menyimpan rekap parkir
        $id_user = Auth::id();
        $kolektor = User::where('role', 'kolektor')->first();
    
        $dataRekap = RekapParkir::create([
            'id_user' => $id_user,
            'id_shift' => $request->id_shift,
            'id_kolektor' => $kolektor->id,
            'tglSetor' => date('Y-m-d H:i'),
            'id_lokasiParkir' => $request->id_lokasiParkir,
            'jumlahMotor' => $totalMotor,
            'jumlahMobil' => $totalMobil,
            'nilaiMotor' => $nilaiMotor,
            'nilaiMobil' => $nilaiMobil,
            'total' => $total,
            'keterangan' => $request->keterangan,
        ]);
    
        // dd($dataRekap);
        return redirect()->route('kolektor.setor')->with('success', 'Semua data berhasil disetor ke kolektor.');

        // return response()->json(['status' => 'success', 'data' => $data], 200);
    }    

    // public function setoran(Request $request) {

    //     // dd($request->all());
        
    //     $dataParkir = Parker::where('id_lokasiParkir', $request->id_lokasiParkir)
    //         ->where('status', 'Belum disetor')
    //         ->get();

    //     $data = Parker::where('id_lokasiParkir', $request->id_lokasiParkir)
    //         ->update([
    //             'status' => 'Sudah disetor'
    //             ]);

    //     // dd($data);

    //     $id_user = Auth::id();

    //     $kolektor = User::where('role', 'kolektor')->first();    
        
    //     $totalMotor = $dataParkir->where('jenisKendaraan', 'Motor')->count();
    //     $totalMobil = $dataParkir->where('jenisKendaraan', 'Mobil')->count();
    //     $nilaiMotor = $dataParkir->where('jenisKendaraan', 'Motor')->sum('penerimaan');
    //     $nilaiMobil = $dataParkir->where('jenisKendaraan', 'Mobil')->sum('penerimaan');
    //     $total = $dataParkir->sum('penerimaan');

    //     $dataRekap = RekapParkir::create([
    //         'id_user' => $id_user,
    //         'id_shift' => $request->id_shift,
    //         'id_kolektor' => $kolektor->id,
    //         'tglSetor' => date('Y-m-d H:i'),
    //         'id_lokasiParkir' => $request->id_lokasiParkir,
    //         'jumlahMotor' => $totalMotor,
    //         'jumlahMobil' => $totalMobil,
    //         'nilaiMotor' => $nilaiMotor,
    //         'nilaiMobil' => $nilaiMobil,
    //         'total' => $total,
    //         'keterangan' => $request->keterangan,
    //     ]);

    //     dd($dataRekap);
        
    //     return response()->json(['status' => 'success', 'data' => $data], 200);
    // }
    
}
