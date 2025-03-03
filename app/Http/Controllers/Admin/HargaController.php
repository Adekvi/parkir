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
        // Query utama untuk mengelompokkan data berdasarkan id_lokasiParkir
        // $rego = Penghargaan::selectRaw('
        //     id_lokasiParkir,
        //     GROUP_CONCAT(jenisKendaraan ORDER BY jenisKendaraan SEPARATOR ", ") as jenis_kendaraan,
        //     GROUP_CONCAT(harga ORDER BY harga SEPARATOR ", ") as tarif
        // ')
        // ->with('lokasi')
        // ->groupBy('id_lokasiParkir')
        // ->orderBy('id_lokasiParkir', 'asc')
        // ->get();

        $rego = Penghargaan::with('lokasi.jalan')->paginate(10);

        // dd($rego);

        $lokasi = JamLokasi::all();

        // Misalnya, Anda mengambil lokasi yang dipilih dari entitas pertama di $rego
        // $selectedLokasi = $rego->isNotEmpty() ? $rego->first()->lokasi->id : null;
        $selectedLokasi = $rego->isNotEmpty() ? $rego->items()[0]->lokasi->id : null;

        return view('admin.harga.index', compact('rego', 'lokasi', 'selectedLokasi'));
    }

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
        $jalan = Jalan::select('namaJalan', 'kodeJln')->find($id);

        if ($jalan) {
            return response()->json([
                'namaJalan' => $jalan->namaJalan,
                'kodeJln' => $jalan->kodeJln,
            ]);
        }

        // Debugging jika data tidak ditemukan
        return response()->json([
            'namaJalan' => 'Data tidak ditemukan',
            'kodeJln' => 'Data tidak ditemukan',
        ]);
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
