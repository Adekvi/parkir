<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ket;
use Illuminate\Http\Request;

class KetController extends Controller
{
    public function index()
    {
        $ket = Ket::orederBy('id', 'desc')->paginate(10);

        return view('admin.ket.index', compact('ket'));
    }

    public function tambah(Request $request)
    {
        $data = [
            'keterangan' => $request->keterangan,
        ];

        Ket::create($data);

        return redirect()->route('admin.ket')->with('success', 'Keterangan berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        $data = [
            'keterangan' => $request->keterangan,
        ];

        Ket::find($id)->update($data);

        return redirect()->route('admin.ket')->with('success', 'Keterangan berhasil diubah');
    }

    public function hapus($id)
    {
        Ket::find($id)->delete();

        return redirect()->route('admin.ket')->with('success', 'Keterangan berhasil dihapus');
    }
}
