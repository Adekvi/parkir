<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JamLokasi;
use App\Models\Shift;
use App\Models\User;
use App\Models\UserLokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateDataController extends Controller
{
    public function get_user(Request $request) {
        $user = User::where('id', $request->id)
            ->with('lokasi_parkir', 'penghargaan', 'shift', 'nama_lokasi')
            ->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    public function get_user_kolektor(Request $request) {
        // $userId = $request->id;

        // // Cek cache terlebih dahulu
        // $cacheKey = "user_$userId";
        // $user = Cache::get($cacheKey);

        // if (!$user) {
        //     // Jika data tidak ada di cache, ambil dari database
        //     $results = DB::select('CALL GetUserById(?)', [$userId]);
        //     $user = $results[0];

        //     // Simpan hasil di cache
        //     Cache::put($cacheKey, json_decode(json_encode($user), true), 60); // Cache selama 60 menit
        // }

        // return response()->json([
        //     'status' => 'success',
        //     'data' => $user,
        // ], 200);

        $user = User::where('id', $request->id)->with('lokasi_parkir', 'penghargaan')->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    public function get_all_user_for_android(){
        $users = User::all()->toArray();

        return response()->json(['status' => 'success', 'users' => $users], 200);
    }

    public function edit(Request $request, $id) {
        $user = User::findOrFail($id);
        $userLokasi = UserLokasi::where('id_user', $id)->first();
        
        $user->update([
            'id_shift' => $request->namaShift,
            'namaLokasi' => $request->namaLokasi,
            'id_lokasiParkir' => $request->lokasiParkir,
            'jekel' => $request->jekel,
            'tglLahir' => $request->tglLahir,
            'tempatLahir' => $request->tempatLahir,
            'email' => $request->email,
        ]);

        $userLokasi->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json(['status' => 'success', 'user' => $user], 200);
    }

    public function showUpdateForm()
    {
        $user = Auth::user();

        $shift = Shift::all();
        $userLokasi = UserLokasi::where('id_user', $user->id)->first();
        $gedung = JamLokasi::all();

        $selectedShift = $user ? $user->id_shift : null;
        $selectedGedung = $user ? $user->id_lokasiParkir : null;
        
        return view('user.update.data', compact('user', 'shift', 'userLokasi', 'gedung', 'selectedShift', 'selectedGedung'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        // dd($request->all());

        // Mengambil user berdasarkan ID
        $user = User::findOrFail($id);

        // Update data di tabel user
        $user->username = $request->username;
        $user->namaLengkap = $request->namaLengkap;
        $user->tempatLahir = $request->tempatLahir;
        $user->tglLahir = $request->tglLahir;
        $user->id_shift = $request->id_shift; // Menyimpan shift berdasarkan relasi
        $user->jekel = $request->jekel;
        $user->id_lokasiParkir = $request->id_lokasiParkir;
        $user->namaLokasi = $request->namaLokasi;
        $user->is_complete = true;

        // Simpan perubahan data user
        $user->save();

        // dd($user);

        // Update atau simpan data di tabel userLokasi
        $userLokasi = UserLokasi::updateOrCreate(
            ['id_user' => $user->id],
            [
                'alamat' => $request->alamat,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]
        );

        // Redirect ke halaman parkir
        return redirect()->route('user.parkir')->with('success', 'Profil berhasil diperbarui dan shift tersimpan.');
    }
}
