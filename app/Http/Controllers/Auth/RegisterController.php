<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\User;
use App\Models\UserLokasi;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'namaLengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'fotoKtp' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4048'],
            'role' => ['nullable', 'not_in:superadmin,admin'],
            'id_shift' => ['required', 'exists:shifts,id'],
            // 'namaLokasi' => ['required', 'string'],
            // 'alamatLokasi' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return redirect()->route('user/parkir-index')->with('success', 'Pendaftaran berhasil, silakan login.');
    }

    protected function create(array $data)
    {
        $defaulfRole = 'user';

        $user = User::create([
            'namaLengkap' => $data['namaLengkap'],
            'username' => $data['username'],
            'email' => $data['email'] ?? null,
            'role' => $data['role'] ?? $defaulfRole,
            // 'password' => Hash::make($data['password']),
            'password' => $data['password'],
            'namaLokasi' => $data['namaLokasi'],
            'id_lokasiParkir' => $data['id_lokasiParkir'],
            'id_shift' => $data['id_shift'],
            'is_complete' => false,
        ]);

        // dd($user);

        if (request()->hasFile('fotoKtp')) {
            $profilePhotoPath = request('fotoKtp')->store('fotoKtpUser', 'public');
            $user->update(['fotoKtp' => $profilePhotoPath]);
        }

        UserLokasi::create([
            'id_user' => $user->id,
            'alamat' => $data['alamat'] ?? null,
            'latitude' => null,
            'longitude' => null,
        ]);

        return $user;
    }

    public function registrasi(Request $data)
    {
        $defaultRole = 'user';

        // Validasi input
        $data->validate([
            'ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        // Menyimpan file KTP ke public disk
        $ktpPath = $data->file('ktp')->store('fotoKtpUser', 'public');
        
        // Menyalin file dari storage/app/public ke public/storage
        $ktpFilePath = storage_path('app/public/' . $ktpPath);  // Path file di storage
        $publicStoragePath = '/home/megawonc/domains/megawoncity.my.id/public_html/storage/' . $ktpPath; // Path tujuan di public/storage
        
        // Pastikan direktori tujuan ada
        $directory = dirname($publicStoragePath);
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true); // Membuat folder jika belum ada
        }
        // return $publicStoragePath;
        // Salin file dari storage ke public/storage
        // copy($ktpFilePath, $publicStoragePath);
        if (!copy($ktpFilePath, $publicStoragePath)) {
            return response()->json([
                'message' => 'Gagal menyalin file ke public/storage.',
            ], 500);
        }


        // Membuat pengguna baru
        $user = User::create([
            'fotoKtp' => $ktpPath, // Simpan path file
            'namaLengkap' => $data['namaLengkap'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        // Menyimpan lokasi pengguna
        UserLokasi::create([
            'id_user' => $user->id,
            'alamat' => $data['alamatLokasi'],
            'latitude' => null,
            'longitude' => null,
        ]);

        // Membuat token untuk autentikasi
        $token = $user->createToken('auth_token')->plainTextToken;

        // Mengambil data pengguna
        $user = User::where('username', $data['username'])->first();

        // Mengembalikan response dengan token dan data pengguna
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'message' => 'Pendaftaran kolektor berhasil'
        ], 200);
    }
}
