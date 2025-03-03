<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Header;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function index(){
        $karcis = Header::all();

        return view('admin.header.index', compact('karcis'));
    }

    public function tambah(Request $request){

        $data = [
            'header1' => $request->header1,
            'header2' => $request->header2,
            'header3' => $request->header3,
            'header4' => $request->header4,
            'footer1' => $request->footer1,
            'footer2' => $request->footer2,
            'footer3' => $request->footer3,
            'footer4' => $request->footer4,
        ];

        // dd($data);

        Header::create($data);

        return redirect()->route('admin.header.index')->with('success', 'Data Berhasil dtambahkan');

    }

    public function edit(Request $request, $id){

        $data = [
            'header1' => $request->header1,
            'header2' => $request->header2,
            'header3' => $request->header3,
            'header4' => $request->header4,
            'footer1' => $request->footer1,
            'footer2' => $request->footer2,
            'footer3' => $request->footer3,
            'footer4' => $request->footer4,
        ];

        Header::where('id', $id)->update($data);

        return redirect()->route('admin.header.index')->with('success', 'Data Berhasil diubah');
    }

    public function hapus($id){
        Header::destroy($id);
        return redirect()->route('admin.header.index')->with('success', 'Data Berhasil dihapus');
    }
}
