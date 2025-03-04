<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jalan;
use App\Models\JamLokasi;
use Illuminate\Http\Request;

class JamController extends Controller
{
    public function index()
    {
        $jam = JamLokasi::with('jalan')->orderBy('id', 'desc')->paginate(10);
        $jalan = Jalan::all();

        $pilihJalan = $jalan->isNotEmpty() ? $jalan->first()->id : null;

        // dd($jam);

        return view('admin.lokasi.index', compact('jam', 'jalan', 'pilihJalan'));
    }

    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            // Query pencarian dengan relasi jalan
            $jam = JamLokasi::with('jalan')
                ->whereHas('jalan', function ($q) use ($query) {
                    $q->where('namaJalan', 'like', "%$query%");
                })
                ->orWhere('tmptParkir', 'like', "%$query%")
                ->orWhere('durasiParkir', 'like', "%$query%")
                ->orWhere('tipe', 'like', "%$query%")
                ->get();

            return response()->json($jam);
        }

        return redirect()->route('admin.lokasi');
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'kodeJln' => 'required',
            'durasiParkir' => 'required',
            'tmptParkir' => 'required',
            'tipe' => 'required'
        ]);

        // Ambil kode jalan terakhir
        $lastKode = JamLokasi::orderBy('kodeJln', 'desc')->first();

        // Jika belum ada data, mulai dari 001
        $newKode = $lastKode ? str_pad((int) $lastKode->kodeJln + 1, 3, '0', STR_PAD_LEFT) : '001';

        // Simpan data dengan kode baru
        $data = [
            'kodeJln' => $newKode,
            'durasiParkir' => $request->durasiParkir,
            'tmptParkir' => $request->tmptParkir,
            'tipe' => $request->tipe,
        ];

        // dd($data);

        JamLokasi::create($data);

        return redirect()->route('admin.lokasi')->with('success', 'Data berhasil ditambahkan');
    }


    public function getKodeJln($id)
    {
        // Cari kodeJln berdasarkan id jalan yang dipilih
        $kodeJln = Jalan::where('id', $id)->value('kodeJln');

        // Pastikan jika tidak ditemukan, mengembalikan kode jalan kosong
        return response()->json(['kodeJln' => $kodeJln ?: '']);
    }

    public function edit(Request $request, $id)
    {
        // Format kodeJln agar tetap dalam bentuk 3 digit (contoh: 001, 002, 010, dst.)
        $formattedKodeJln = str_pad($request->kodeJln, 3, '0', STR_PAD_LEFT);

        // Data yang akan diperbarui
        $data = [
            'kodeJln' => $formattedKodeJln,
            'durasiParkir' => $request->durasiParkir,
            'tmptParkir' => $request->tmptParkir,
            'tipe' => $request->tipe,
        ];

        JamLokasi::find($id)->update($data);
        return redirect()->route('admin.lokasi')->with('success', 'Data berhasil ditambahkan');
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

    public function hapus($id)
    {
        JamLokasi::destroy($id);
        return redirect()->route('admin.lokasi')->with('success', 'Data berhasil dihapus');
    }

    // hosting
    public function index_for_android(Request $request)
    {
        $lokasiParkir = JamLokasi::all()->toArray();
        return response()->json([
            'status' => 'success',
            'lokasiParkir' => $lokasiParkir,
        ], 200);
    }

    public function get_lokasi_parkir_by_jalan_for_android($jalan)
    {
        $data = JamLokasi::where('kodeJln', $jalan)->get();

        return response()->json(['status' => 'success', 'lokasiParkir' => $data], 200);
    }

    public function get_lokasi_parkir_by_id($id)
    {
        $data = JamLokasi::where('id', $id)->first();

        return response()->json(['status' => 'success', 'data' => $data], 200);
    }
}
