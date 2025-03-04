<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JalanController extends Controller
{
    public function index()
    {
        $jalan = Jalan::paginate(10);

        return view('admin.jalan.index', compact('jalan'));
    }

    public function tambah(Request $request)
    {
        // Validasi input
        $request->validate([
            'namaJalan' => 'required|string|max:255',
        ]);

        // Cari kode terakhir di tabel jalan
        $lastKode = Jalan::orderBy('kodeJln', 'desc')->first();

        // Ambil angka terakhir dari kode (misalnya "JL001" -> 1)
        $lastNumber = $lastKode ? (int) substr($lastKode->kodeJln, 2) : 0;

        // Buat kode baru
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $newKodeJln = 'JL' . $newNumber;

        // Simpan data
        Jalan::create([
            'namaJalan' => $request->namaJalan,
            'kodeJln' => $newKodeJln,
        ]);

        return redirect()->route('admin.jalan.index')->with('success', 'Nama jalan berhasil ditambahkan');
    }

    public function getLastKodeJln()
    {
        // Cari kode terakhir di tabel jalan
        $lastKode = Jalan::orderBy('kodeJln', 'desc')->first();

        // Jika tidak ada kode terakhir, mulai dari "JL001"
        if (!$lastKode) {
            $newKodeJln = 'JL001';
        } else {
            // Ambil angka terakhir dari kode (misalnya "JL001" -> 1)
            $lastNumber = (int) substr($lastKode->kodeJln, 2);

            // Buat kode baru
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            $newKodeJln = 'JL' . $newNumber;
        }

        Log::info('Kode Jalan:', ['kodeJln' => $newKodeJln]);

        // Kembalikan hasil sebagai JSON
        return response()->json(['kodeJln' => $newKodeJln]);
    }

    public function edit(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'namaJalan' => 'required|string|max:255',
        ]);

        // Temukan data jalan berdasarkan ID
        $jalan = Jalan::findOrFail($id);

        // Periksa apakah nama jalan diubah
        $jalan->namaJalan = $request->namaJalan;

        // Jika Anda ingin memperbarui kodeJln (opsional), tambahkan logika ini
        // if ($request->has('kodeJln')) {
        //     $jalan->kodeJln = $request->kodeJln;
        // }

        // Simpan perubahan
        $jalan->save();

        return redirect()->route('admin.jalan.index')->with('success', 'Nama jalan berhasil diubah');
    }

    public function hapus($id)
    {
        Jalan::destroy($id);

        return redirect()->route('admin.jalan.index')->with('success', 'Nama jalan berhasil dihapus');
    }

    public function index_for_android()
    {
        $jalans = Jalan::all();

        return response()->json(['status' => 'success', 'jalans' => $jalans], 200);
    }
}
