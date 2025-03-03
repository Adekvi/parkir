<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\JamLokasi;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::with('lokasi')
            ->get();

        // dd($kendaraan);

        $lokasi = JamLokasi::all();

        return view('super.kendaraan.index', compact('kendaraan', 'lokasi'));
    }

    public function tambah(Request $request)
    {
        // $jamLokasi = JamLokasi::where('id', $request['id_jamLokasi'])->first();

        $data = [
            'jenisKendaraan' => $request['jenisKendaraan'],
            'tarif' => $request['tarif'],
            'id_jamLokasi' => $request['id_jamLokasi'],
        ];

        // dd($data);

        Kendaraan::create($data);

        return redirect()->route('super.data-kendaraan')->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $kendaraan->delete();

        return redirect()->route('super.data-kendaraan')->with('success', 'Data kendaraan berhasil dihapus');
    }
}
