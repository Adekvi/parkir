<?php

namespace App\Http\Controllers\Kasir\Inap;

use App\Http\Controllers\Controller;
use App\Models\DataPelanggan;
use App\Models\Jalan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){
        $pelanggan = DataPelanggan::with('jalan')->get();
        // dd($pelanggan);
        $jalan = Jalan::all();

        $selectedJalan = Jalan::first()->namaJalan ?? null;

        return view('kasir.inap.index', compact('pelanggan', 'jalan', 'selectedJalan'));
    }


    // public function tagih(Request $request, $id)
    // {
    //     $inap = DataPelanggan::find($id);
        
    //     if (!$inap) {
    //         return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
    //     }

    //     // Simpan nilai 'dibayar' ke database
    //     $inap->pembayaran = $request->input('dibayar', $inap->pembayaran);
    //     $inap->save();

    //     return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    // }

    public function tagih(Request $request, $id)
    {
        $inap = DataPelanggan::with('jalan')->where('id', $id)->first();
        
        // dd($inap);
        // Menentukan angsuran yang harus dibayar (pembayaran)
        $angsuran = $inap->pembayaran;

        // Mendapatkan nilai yang telah dibayar dari input form (misalnya $request->dibayar)
        $telahDibayar = $request->input('dibayar', 0);

        // Menghitung kurang dibayar (angsuran - telah dibayar)
        $kurangDibayar = $angsuran - $telahDibayar;

        // Menghitung total yang harus dibayar (berdasarkan pembayaran)
        $total = $angsuran;

        // Menghitung tanggal jatuh tempo (tanggal penerbitan + 31 hari)
        $tanggalPenerbitan = new \Carbon\Carbon($inap->jatuhTempo);
        $tanggalJatuhTempo = $tanggalPenerbitan->addDays(31)->toDateString();

        return view('kasir.inap.surat.index', compact('inap', 'angsuran', 'telahDibayar', 'kurangDibayar', 'total', 'tanggalJatuhTempo'));
    }

    public function cetakParkirInap($id)
    {
        $inap = DataPelanggan::with('jalan')->find($id);

        if (!$inap) {
            abort(404, 'Data tidak ditemukan');
        }

        return view('kasir.inap.cetak', compact('inap'));
    }


    public function tambah(Request $request){
        $data = [
            'namaPendaftar' => $request->namaPendaftar,
            'namaJalan' => $request->namaJalan,
            'jatuhTempo' => $request->jatuhTempo,
            'namaSTNK' => $request->namaSTNK,
            'platKendaraan' => $request->platKendaraan,
            'pembayaran' => $request->pembayaran,
            'handphone' => $request->handphone,
        ];

        // dd($data);
        
        DataPelanggan::create($data);

        return redirect()->route('kasir.inap')->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        $data = [
            'namaPendaftar' => $request->namaPendaftar,
            'namaJalan' => $request->namaJalan,
            'jatuhTempo' => $request->jatuhTempo,
            'namaSTNK' => $request->namaSTNK,
            'platKendaraan' => $request->platKendaraan,
            'pembayaran' => $request->pembayaran,
            'handphone' => $request->handphone,
        ];

        DataPelanggan::where('id', $id)->update($data);

        return redirect()->route('kasir.inap')->with('success', 'Data pelanggan berhasil diubah');
    }

    public function hapus($id){
        DataPelanggan::destroy($id);

        return redirect()->route('kasir.inap')->with('success', 'Data pelanggan berhasil dihapus');
    }
}
