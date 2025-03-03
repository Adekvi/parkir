<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Kolektor\JamController;
use App\Http\Controllers\Kolektor\KolektorController;
use App\Http\Controllers\Kolektor\PembayaranController;
use App\Http\Controllers\Kolektor\RegisterKolektorController;
use App\Http\Controllers\Kolektor\SetorController;
use App\Http\Controllers\Kolektor\ShiftController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ParkirController;
use App\Http\Controllers\User\UpdateDataController;
use App\Models\Ket;
use App\Models\Shift;
// use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Route::put('user/update/{id}', [UpdateDataController::class, 'update'])->name('user.update.data');


// Kolektor
Route::get('get-user-by-id/{id}', function ($id) {
    $user = User::where('id', $id)->first();

    return response()->json(['status' => 'success', 'user' => $user], 200);
});
Route::get('pendaftaran-kolektor', [RegisterKolektorController::class, 'formKolektor'])->name('kolektor.form');
Route::post('pendaftaran-kolektor', [RegisterKolektorController::class, 'storeKolektor'])->name('kolektor.store');
Route::post('login-kolektor', [LoginController::class, 'store'])->name('login.store');

// Route::get('kolektor/shift', [ShiftController::class, 'index']);
// Route::post('kolektor/shift-tambah', [ShiftController::class, 'tambah'])->name('kolektor.shift-tambah');
// Route::put('kolektor/shift-edit/{id}', [ShiftController::class, 'edit'])->name('kolektor.shift-edit');
// Route::delete('kolektor/shift-hapus/{id}', [ShiftController::class, 'hapus'])->name('kolektor.shift-hapus');

// Route::get('kolektor/lokasi-parkir', [JamController::class, 'index'])->name('kolektor.jam');
// Route::post('kolektor/lokasi-parkir/tambah', [JamController::class, 'tambah'])->name('kolektor.jam-tambah');
// Route::put('kolektor/jam-edit/{id}', [JamController::class, 'edit'])->name('kolektor.jam-edit');
// Route::delete('kolektor/jam-hapus/{id}', [JamController::class, 'hapus'])->name('kolektor.jam-hapus');

Route::get('kolektor/setoran-group-by-wilayah', [PembayaranController::class, 'setoran_group_by_wilayah']);
Route::get('kolektor/setoran-group-by-wilayah-done', [PembayaranController::class, 'setoran_group_by_wilayah_done']);
Route::get('kolektor/detail/{id}', [KolektorController::class, 'index']);
Route::get('kolektor/detail/persetujuan/{id}', [KolektorController::class, 'persetujuan']);
Route::get('kolektor/setoran-by-id-wilayah/{id}', [KolektorController::class, 'setoran_by_id_wilayah']);
Route::get('kolektor/setoran-by-id-wilayah/persetujuan/{id}', [KolektorController::class, 'setoran_by_id_wilayah_persetujuan']);
Route::put('kolektor/setoran', [PembayaranController::class, 'setoran']);

Route::get('kolektor/detail/all-location/{id}', [KolektorController::class, 'detail_all_location']);

Route::get('toolless/lokasi', [KolektorController::class, 'search_lokasi_toolless']);
Route::get('toolless/petugas', [KolektorController::class, 'search_petugas_toolless']);
Route::post('toolless/save', [KolektorController::class, 'save_data_toolless']);
Route::get('toolless/get/keterangan', function() {
    $data = Ket::all();

    return response()->json(['status' => 'success', 'data' => $data], 200);
});

// Petugas
// registrasi
Route::post('pendaftaran-petugas', [RegisterController::class, 'registrasi']);

// home
Route::get('user/{id}', [UpdateDataController::class, 'get_user']);
Route::post('user/parkir/tambah', [ParkirController::class, 'tambah'])->name('user.parkir.tambah');
Route::get('periksa-kendaraan-keluar/{plat}', [ParkirController::class, 'periksa_kendaraan_keluar']);

// tarif
// Route::get('tarif-kendaraan-per-lokasi/{id}', [PenghargaanController::class, 'index']);

// laporan
Route::get('laporan/parkir/{wilayah}', [ParkirController::class, 'index'])->name('user.parkir');

// akun
Route::put('update-profile/{id}', [UpdateDataController::class, 'edit']);

// Route::get('get-lokasi-parkir-by-id/{id}', [JamController::class, 'get_lokasi_parkir_by_id']);

// Update data diri user
Route::get('user/update/form', [UpdateDataController::class, 'showUpdateForm'])->name('user.update.form');
Route::put('user/update/{id}', [UpdateDataController::class, 'update'])->name('user.update.data');

// transaksi parkir
Route::get('user/parkir', [ParkirController::class, 'index'])->name('user.parkir.index');
Route::post('user/parkir/tambah', [ParkirController::class, 'tambah'])->name('user.parkir.tambah');
Route::get('/get-harga/{id}', [ParkirController::class, 'getHarga'])->name('get-harga');

// Kolektor
// Route untuk pendaftaran kolektor (di luar middleware kolektor)
Route::get('login/kolektor', [LoginController::class, 'formKolektor'])->name('login.kolektor');
Route::get('pendaftaran-kolektor', [RegisterKolektorController::class, 'formKolektor'])->name('kolektor.form');
Route::post('pendaftaran-kolektor', [RegisterKolektorController::class, 'storeKolektor'])->name('kolektor.store');

Route::middleware(['auth', 'kolektor'])->namespace('kolektor')->group(function () {
    Route::get('kolektor/index', [kolektorController::class, 'index'])->name('kolektor.index');

    // data setor
    Route::get('kolektor/setor', [PembayaranController::class, 'index'])->name('kolektor.setor');
    Route::post('kolektor/setor-tambah', [PembayaranController::class, 'setoran'])->name('kolektor.setor-tambah');

    // data telah disetor
    Route::get('kolektor/disetor', [SetorController::class, 'disetor'])->name('kolektor.disetor'); 
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('pendaftaran-kolektor', [RegisterKolektorController::class, 'formKolektor'])->name('kolektor.form');
// Route::post('pendaftaran-kolektor', [RegisterKolektorController::class, 'storeKolektor'])->name('kolektor.store');

// Route::get('user', function() {
//     $user = Shift::all();

//     return response()->json($user);

// });