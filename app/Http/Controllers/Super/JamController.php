<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\JamLokasi;
use Illuminate\Http\Request;

class JamController extends Controller
{
    public function index(){
        $jam = JamLokasi::all();

        return view('super.jam.index', compact('jam'));
    }

    public function tambah(Request $request){
        $request->validate([
            'durasiParkir' => 'required',
            'tmptParkir' => 'required',
            'tipe' => 'required'
        ]);

        $data = [
            'durasiParkir' => $request->durasiParkir,
            'tmptParkir' => $request->tmptParkir,
            'tipe' => $request->tipe,
        ];

        JamLokasi::create($data);
        return redirect()->route('super.jam')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Request $request, $id){
        $request->validate([
            'durasiParkir' => 'required',
            'tmptParkir' => 'required',
            'tipe' => 'required'
        ]);

        $data = [
            'durasiParkir' => $request->durasiParkir,
            'tmptParkir' => $request->tmptParkir,
            'tipe' => $request->tipe,
        ];

        JamLokasi::find($id)->update($data);
        return redirect()->route('super.jam')->with('success', 'Data berhasil ditambahkan');
    }

    public function getDurasiParkir($tmptParkir)
    {
        // Mengambil data durasi parkir berdasarkan tempat parkir
        $jamLokasi = JamLokasi::where('tmptParkir', $tmptParkir)->first();

        if ($jamLokasi) {
            return response()->json(['durasiParkir' => $jamLokasi->durasiParkir]);
        }

        return response()->json(['durasiParkir' => 0]);
    }

    public function hapus($id){
        JamLokasi::destroy($id);
        return redirect()->route('super.jam')->with('success', 'Data berhasil dihapus');
    }
}
