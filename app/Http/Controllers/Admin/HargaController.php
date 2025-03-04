<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jalan;
use App\Models\JamLokasi;
use App\Models\Penghargaan;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function index()
    {
        // Ambil data dengan relasi lokasi -> jalan
        $rego = Penghargaan::with('lokasi.jalan')->orderBy('id', 'desc')->paginate(10);
        // dd($rego);
        $jalan = Jalan::all();

        // Ambil daftar lokasi parkir
        $lokasi = JamLokasi::all();

        // Konversi hasil paginasi ke koleksi agar bisa pakai first()
        $regoCollection = collect($rego->items());

        // Cek apakah ada data sebelum mengambil nilai pertama
        $selectedLokasi = $regoCollection->isNotEmpty() ? optional($regoCollection->first()->lokasi)->id : null;
        $selectedJalan = $regoCollection->isNotEmpty() ? optional($regoCollection->first()->lokasi->jalan)->id : null;

        // dd($selectedJalan);

        return view('admin.harga.index', compact('rego', 'lokasi', 'jalan', 'selectedLokasi', 'selectedJalan'));
    }

    // public function index()
    // {
    //     $rego = Penghargaan::with('lokasi.jalan')
    //         ->get()
    //         ->groupBy('lokasi.jalan.namaJalan');

    //     // dd($rego);

    //     $lokasi = JamLokasi::all();

    //     $selectedLokasi = $rego->isNotEmpty() ? $rego->values()->first()->first()->lokasi->id : null;

    //     return view('admin.harga.index', compact('rego', 'lokasi', 'selectedLokasi'));
    // }

    public function tambah(Request $request)
    {

        // dd($request->all());
        $jamLokasi = JamLokasi::where('id', $request['id_jamLokasi'])->first();

        $data = [
            'jenisKendaraan' => $request->jenisKendaraan,
            'harga' => $request->harga,
            'id_lokasiParkir' => $request->id_lokasiParkir,
        ];

        // dd($data);

        Penghargaan::create($data);

        return redirect()->route('admin.harga')->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    public function getNamaJalan($id)
    {
        // Cari lokasi parkir beserta jalan yang sesuai berdasarkan kodeJln
        $lokasi = JamLokasi::with('jalan')->find($id);

        if ($lokasi && $lokasi->jalan) {
            return response()->json([
                'namaJalan' => $lokasi->jalan->namaJalan,
                'kodeJln' => $lokasi->jalan->kodeJln,
            ]);
        }

        return response()->json([
            'namaJalan' => 'Data tidak ditemukan',
            'kodeJln' => 'Data tidak ditemukan',
        ]);
    }

    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            // Query pencarian dengan relasi lokasi -> jalan
            $jam = Penghargaan::with('lokasi.jalan')
                ->whereHas('lokasi.jalan', function ($q) use ($query) {
                    $q->where('namaJalan', 'like', "%$query%");
                })
                ->orWhereHas('lokasi', function ($q) use ($query) {
                    $q->where('id', 'like', "%$query%");
                })
                ->orWhere('jenisKendaraan', 'like', "%$query%")
                ->orWhere('harga', 'like', "%$query%")
                ->orderBy('id', 'desc')
                ->get();

            return response()->json($jam);
        }

        return redirect()->route('admin.harga');
    }

    public function edit(Request $request, $id)
    {
        // $jamLokasi = JamLokasi::where('id', $request['id_jamLokasi'])->first();

        $data = [
            'jenisKendaraan' => $request->jenisKendaraan,
            'harga' => $request->harga,
            'id_lokasiParkir' => $request->id_lokasiParkir,
        ];

        // dd($data);

        Penghargaan::find($id)->update($data);

        return redirect()->route('admin.harga')->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    public function hapus($id)
    {
        Penghargaan::destroy($id);

        return redirect()->route('admin.harga')->with('success', 'Data kendaraan berhasil dihapus');
    }

    public function index_for_android($id)
    {
        $penghargaan = Penghargaan::where('id_lokasiParkir', $id)->get();
        return response()->json(['status' => 'success', 'penghargaan' => $penghargaan], 200);
    }
}
