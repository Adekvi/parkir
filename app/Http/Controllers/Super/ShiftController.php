<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index(){
        $shift = Shift::all();

        // dd($shift);

        return view('super.shift.index', compact('shift'));
    }

    public function tambah(Request $request){

        // $request->validate([
        //     'namaShift' =>'required|max:255',
        //     'mulai' =>'required|date_format:H:i',
        //     'akhir' =>'required|date_format:H:i|after:mulai',
        // ]);

        $data = [
            'namaShift' => $request->namaShift,
            'mulai' => \Carbon\Carbon::createFromFormat('H:i', $request->mulai)->format('H:i'),
            'akhir' => \Carbon\Carbon::createFromFormat('H:i', $request->akhir)->format('H:i'),
        ];

        // dd($data);

        // Simpan data ke database
        Shift::create($data);

        return redirect()->route('super.shift')->with('success', 'Data shift berhasil ditambahkan');
    }

    public function edit(Request $request, $id){
        // Validasi data
        // $request->validate([
        //     'namaShift' =>'required|string|max:255',
        //     'mulai' =>'required|date_format:H:i',
        //     'akhir' =>'required|date_format:H:i|after:mulai',
        // ]);

        $data = [
            'namaShift' => $request->namaShift,
            'mulai' => \Carbon\Carbon::createFromFormat('H:i', $request->mulai)->format('H:i'),
            'akhir' => \Carbon\Carbon::createFromFormat('H:i', $request->akhir)->format('H:i'),
        ];

        // Update data ke database
        Shift::where('id', $id)->update($data);

        return redirect()->route('super.shift')->with('success', 'Data shift berhasil diubah');
    }

    public function hapus($id){
        // Hapus data di database
        Shift::destroy($id);

        return redirect()->route('super.shift')->with('success', 'Data shift berhasil dihapus');
    }
}
