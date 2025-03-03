<?php

namespace App\Http\Controllers\Kolektor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterKolektorController extends Controller
{
    public function formKolektor()
    {
        return view('kolektor.register');
    }

    // public function validatorKolektor(array $data)
    // {
    //     return Validator::make($data, [
    //         'namaLengkap' => ['required', 'string', 'max:255'],
    //         'username' => ['required', 'string', 'max:255', 'unique:users'],
    //         'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'namaLokasi' => ['required', 'string', 'max:255'],
    //         'alamatLokasi' => ['required', 'string', 'max:255'],
    //         'fotoKtp' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Validasi untuk upload foto KTP
    //     ]);
    // }

    // public function storeKolektor(Request $request)
    // {
    //     try {
    //         $this->validatorKolektor($request->all())->validate();
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return redirect()
    //             ->back()
    //             ->withErrors($e->validator)
    //             ->withInput();
    //     }

    //     $kolektor = $this->createKolektor($request->all());

    //     return redirect()->route('kolektor.index')->with('success', 'Pendaftaran kolektor berhasil.');
    // }

    public function storeKolektor(Request $request)
    {

        $roleKolektor = 'kolektor';

        $user = User::create([
            'namaLengkap' => $request->input('namaLengkap'),
            'username' => $request->input('username'),
            'email' => $request->input('email') ?? null,
            'role' => $roleKolektor,
            'password' => Hash::make($request->input('password')),
        ]);

        // if ($request->hasFile('fotoKtp')) {
        //     $profilePhotoPath = $request->file('fotoKtp')->store('fotoKtpUser', 'public');
        //     $user->update(['fotoKtp' => $profilePhotoPath]);
        // }
        // Login pengguna baru
        Auth::login($user);

        // $token = $user->createToken('auth_token')->plainTextToken;

        // Log::info('Sending response: ', ['message' => 'berhasil']);
        
        // return redirect()->route('kolektor.index')->with('success', 'Pendaftaran kolektor berhasil.');
        return response()->json(
            ['redirect' => route('kolektor.index' ),
            // 'access_token' => $token,
            // 'token_type' => 'Bearer',
            // 'user' => $user,
            'message' => 'Pendaftaran kolektor berhasil'], 200
        );
    }

    // hosting
    public function storeKolektorForAndroid(Request $request)
    {

        $roleKolektor = 'kolektor';

        // Validasi input
        // $request->validate([
        //     'ktp' => 'image|mimes:jpeg,png,jpg,gif|max:2024',
        // ]);

        // // Menyimpan file KTP ke public disk
        // $ktpPath = $request->file('ktp')->store('fotoKtpUser', 'public');
        
        // // Menyalin file dari storage/app/public ke public/storage
        // $ktpFilePath = storage_path('app/public/' . $ktpPath);  // Path file di storage
        // $publicStoragePath = '/home/megawonc/domains/megawoncity.my.id/public_html/storage/' . $ktpPath; // Path tujuan di public/storage
        
        // // Pastikan direktori tujuan ada
        // $directory = dirname($publicStoragePath);
        // if (!file_exists($directory)) {
        //     mkdir($directory, 0777, true); // Membuat folder jika belum ada
        // }
        // // return $publicStoragePath;
        // // Salin file dari storage ke public/storage
        // // copy($ktpFilePath, $publicStoragePath);
        // if (!copy($ktpFilePath, $publicStoragePath)) {
        //     return response()->json([
        //         'message' => 'Gagal menyalin file ke public/storage.',
        //     ], 500);
        // }

        $user = User::create([
            // 'fotoKtp' => $ktpPath,
            'fotoKtp' => "",
            'namaLengkap' => $request->input('namaLengkap'),
            'username' => $request->input('username'),
            'email' => $request->input('email') ?? null,
            'role' => $roleKolektor,
            'password' => Hash::make($request->input('password')),
        ]);

        // if ($request->hasFile('fotoKtp')) {
        //     $profilePhotoPath = $request->file('fotoKtp')->store('fotoKtpUser', 'public');
        //     $user->update(['fotoKtp' => $profilePhotoPath]);
        // }
        // Login pengguna baru
        // Auth::login($user);

        Log::info('Sending response: ', ['message' => 'berhasil']);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'message' => 'Pendaftaran kolektor berhasill'], 200);
        // return new UserResource($user);
    }
}
