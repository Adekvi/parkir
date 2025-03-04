<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Http\Controllers\Controller;
use App\Models\Jalan;
use App\Models\JamLokasi;
use App\Models\Shift;
use App\Models\User;
use App\Models\UserLokasi;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $akun = User::with('shift', 'jam', 'jalan')
            ->whereIn('role', ['user', 'kolektor'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        // dd($akun->toArray());

        $shift = Shift::all();
        $dalan = Jalan::all();
        $lokasi = JamLokasi::all();
        // dd($akun);

        return view('admin.akun.index', compact('akun', 'shift', 'dalan', 'lokasi'));
    }

    public function statusAkun(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'id' => 'required|exists:users,id',
            'status' => 'nullable|boolean', // Status harus berupa boolean
        ]);

        // Ambil akun berdasarkan ID
        $akun = User::findOrFail($request->id);

        // Perbarui status akun (0: Nonaktif, 1: Aktif)
        $akun->status = $request->status ? 1 : 0;
        $akun->save();

        // Redirect dengan pesan sukses
        $message = $akun->status ? 'Akun berhasil diaktifkan.' : 'Akun berhasil dinonaktifkan.';
        return redirect()->route('admin.akun')->with('success', $message);
    }

    public function daftar(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'namaLokasi' => 'nullable|exists:jalans,kodeJln',
        ]);

        $akun = User::create([
            'namaLengkap' => $request->namaLengkap,
            'username' => $request->username,
            'password' => $request->password,
            'jekel' => $request->jekel,
            'tglLahir' => $request->tglLahir,
            'tempatLahir' => $request->tempatLahir,
            'email' => $request->email ?? null,
            'role' => $request->role,
            'id_lokasiParkir' => $request->id_lokasiParkir,
            'namaLokasi' => $request->namaLokasi,
            'id_shift' => $request->id_shift,
            'status' => 0,
        ]);

        if (request()->hasFile('fotoKtp')) {
            $profilePhotoPath = request('fotoKtp')->store('fotoKtpUser', 'public');
            $akun->update(['fotoKtp' => $profilePhotoPath]);
        }

        // dd($akun);

        UserLokasi::create([
            'id_user' => $akun->id,
            'alamat' => $request->alamat ?? null,
            'latitude' => null,
            'longitude' => null,
        ]);

        return redirect()->route('admin.akun')->with('success', 'Akun berhasil didaftarkan.');
    }
}
