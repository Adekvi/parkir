<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ket;
use App\Models\Parker;
use App\Models\Penghargaan;
use App\Models\Shift;
use App\Models\User;
use App\Models\UserLokasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkirController extends Controller
{
    public function index(){

        // $user = Auth::user();
        $parker = Parker::with('shift', 'ket')->get();

        // dd($parker);
        // $userLokasi = UserLokasi::where('id_user', $user->id)->first();

        $user = User::where('id', Auth::id())->with('shift')->first();
        $shift = Shift::all(); 
        $kendaraan = Penghargaan::all();   
        $ket = Ket::all(); 

        // dd($parker);

        return view('user.parkir.index', compact('parker', 'shift', 'user', 'kendaraan', 'ket'));
    }

    public function tambah(Request $request)
    {
        // Ambil ID user yang sedang login
        $id_user = Auth::id();

        // Data untuk disimpan
        $data = [
            'id_user' => $id_user,
            'id_shift' => $request['id_shift'],
            'id_lokasiParkir' => $request['id_lokasiParkir'],
            'tglParkir' => $request['tglParkir'],
            'nopol' => $request['nopol'],
            'jenisKendaraan' => $request['jenisKendaraan'],
            'penerimaan' => $request['penerimaan'],
            'keterangan' => $request['keterangan'],
            'status' => $request['status'] ?? 'Belum disetor', // Default status jika tidak diisi
            // 'created.at' => $today,
        ];

        // dd($data);
        // Simpan data ke tabel parker
        Parker::create($data);

        $user = User::findOrFail($id_user);

        // Cek apakah user sudah memiliki data koordinat
        $userLokasi = UserLokasi::where('id_user', $user->id)->first();

        if (!$userLokasi) {
            // Jika belum ada, simpan koordinat
            UserLokasi::create([
                'id_user' => $user->id,
                'alamat' => $request->alamat,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            // dd($user);
        }

        // Redirect ke halaman indeks pengguna dengan pesan sukses
        return redirect()->route('user.parkir.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function getHarga($id)
    {
        $harga = Penghargaan::where('id', $id)->value('harga'); // Mengambil hanya harga berdasarkan id
        return response()->json(['harga' => $harga]);
    }

    // hosting
    public function transaksi(Request $request)
    {
        // Ambil ID user yang sedang login
        $id_user = Auth::id();

        // Validasi input
        // $validatedData = $request->validate([
        //     'id_shift' => 'required|exists:shifts,id', // Memastikan shift valid
        //     'tglParkir' => 'required|date',
        //     'nopol' => 'required|string|max:20',
        //     'penerimaan' => 'required|numeric|min:0',
        //     'status' => 'nullable|string|in:active,inactive', // Jika status tidak wajib
        // ]);

        // Data untuk disimpan

        $tanggalHariIni = now()->toDateString();
        $data = [
            'id_user' => $request->id_user,
            'id_shift' => $request['id_shift'],
            'kodeJln' => $request->kodeJln,
            'id_lokasiParkir' => $request['id_lokasiParkir'],
            'tglParkir' => $tanggalHariIni,
            'nopol' => $request['nopol'],
            'jenisKendaraan' => $request['jenisKendaraan'],
            'penerimaan' => $request['penerimaan'],
            'status' => "Belum disetor", // Default status jika tidak diisi
        ];

        // Simpan data ke tabel parker
        Parker::create($data);

        // Redirect ke halaman indeks pengguna dengan pesan sukses
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function periksa_kendaraan_keluar($plat) {
        $plat = str_replace(' ', '', $plat);
        // Mengambil data parkir berdasarkan plat nomor
        $data = Parker::whereRaw("REPLACE(nopol, ' ', '') = ?", [$plat])
            ->first();

        if ($data) {
            // Mengonversi 'created_at' dan 'updated_at' ke timezone Asia/Jakarta
            $data->created_at = Carbon::parse($data->created_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');
            $data->updated_at = Carbon::parse($data->updated_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');

            // Mengembalikan data sebagai JSON dengan status success
            return response()->json(['status' => 'success', 'data' => $data], 200);
        }
        
        // Jika data tidak ditemukan, mengembalikan response error
        return response()->json(['status' => 'error', 'data' => 'Nopol tidak ditemukan'], 404);
    }

    public function index_for_android($wilayah, $id_user){

        $parker = Parker::where('id_lokasiParkir', $wilayah)
            ->where('status', 'Belum disetor')
            ->where('id_user', $id_user)
            ->orderBy('created_at', 'desc')
            ->get();
        $shift = Shift::all();     

        // dd($parker);

        // return view('user.parkir.index', compact('parker', 'shift'));

        return response()->json(['status' => 'success', 'parkir' => $parker], 200);
    }

    public function data_parkir_by_id_wilayah($kodeJln, $idWilayah, $id_user) {
        // Ambil data yang sudah dikelompokkan berdasarkan tglParkir
        $groupedData = Parker::select(
                'tglParkir',
                DB::raw('SUM(penerimaan) as total'), // Total penerimaan
                DB::raw('SUM(CASE WHEN jenisKendaraan = "Motor" THEN 1 ELSE 0 END) as total_motor'), // Total kendaraan motor
                DB::raw('SUM(CASE WHEN jenisKendaraan = "Mobil" THEN 1 ELSE 0 END) as total_mobil'), // Total kendaraan mobil
                DB::raw('SUM(CASE WHEN jenisKendaraan = "Motor" THEN penerimaan ELSE 0 END) as nilai_motor'), // Total penerimaan motor
                DB::raw('SUM(CASE WHEN jenisKendaraan = "Mobil" THEN penerimaan ELSE 0 END) as nilai_mobil')  // Total penerimaan mobil
            )
            ->where('id_user', $id_user)
            ->where('id_lokasiParkir', $idWilayah)
            ->where('kodeJln', $kodeJln)
            ->where('status', 'Belum disetor')
            ->groupBy('tglParkir') // Group by tglParkir
            ->orderBy('tglParkir', 'asc')
            ->get()
            ->map(function ($group) use ($kodeJln, $idWilayah, $id_user) {
                // Ambil detail data untuk setiap tglParkir
                $details = Parker::where('id_user', $id_user)
                    ->where('id_lokasiParkir', $idWilayah)
                    ->where('kodeJln', $kodeJln)
                    ->where('tglParkir', $group->tglParkir)
                    ->where('status', 'Belum disetor')
                    ->with(['lokasi_parkir', 'user', 'shift']) // Relasi yang sesuai
                    ->get();

                return [
                    'tglParkir' => $group->tglParkir,
                    'total' => $group->total,
                    'total_motor' => $group->total_motor,
                    'total_mobil' => $group->total_mobil,
                    'nilai_motor' => $group->nilai_motor,
                    'nilai_mobil' => $group->nilai_mobil,
                    'details' => $details,
                ];
            });

        return response()->json(['status' => 'success', 'data' => $groupedData], 200);
    }

    // public function setor(Request $request, $id){
    //     // Ambil data parker berdasarkan ID
    //     $parker = Parker::findOrFail($id);

    //     // Validasi input
    //     // $validatedData = $request->validate([
    //     //     'penerimaan' => 'required|numeric|min:0',
    //     //     'status' => 'required|string|in:active,inactive',
    //     // ]);

    //     // Data untuk disimpan
    //     $data = [
    //         'penerimaan' => $request['penerimaan'],
    //         'status' => $request['status'],
    //     ];

    //     // Update data parker
    //     $parker->update($data);

    //     // Redirect ke halaman indeks pengguna dengan pesan sukses
    //     return redirect()->route('user.parkir.index')->with('success', 'Data berhasil disetor');
    // }

}
