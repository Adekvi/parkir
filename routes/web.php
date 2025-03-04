<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Akun\AkunController;
use App\Http\Controllers\Admin\Akun\DaftarAkunController;
use App\Http\Controllers\Admin\HargaController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\JalanContorller;
use App\Http\Controllers\Admin\JalanController as AdminJalanController;
use App\Http\Controllers\Admin\JamController as AdminJamController;
use App\Http\Controllers\Admin\KendaraanController as AdminKendaraanController;
use App\Http\Controllers\Admin\KetController;
use App\Http\Controllers\Admin\KirimLaporanController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\Prediksi\PrediksiController;
use App\Http\Controllers\Admin\Report\DalanController;
use App\Http\Controllers\Admin\Report\DayController;
use App\Http\Controllers\Admin\Report\JuruController;
use App\Http\Controllers\Admin\Report\KolekController;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Admin\Report\WulanController;
use App\Http\Controllers\Admin\SetorLaporanController;
use App\Http\Controllers\Admin\ShiftController as AdminShiftController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\kolektor\kolektorController;
use App\Http\Controllers\kolektor\DataKendaraanController;
use App\Http\Controllers\kolektor\JamController;
use App\Http\Controllers\kolektor\PembayaranController;
use App\Http\Controllers\kolektor\ShiftController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Kasir\DataSetoranKolektorController;
use App\Http\Controllers\Kasir\Inap\PelangganController;
use App\Http\Controllers\Kasir\IndexController;
use App\Http\Controllers\Kasir\JuruParkirController;
use App\Http\Controllers\Kasir\ParkirInapController;
use App\Http\Controllers\Kasir\Report\Bulanan\BulananController;
use App\Http\Controllers\Kasir\Report\Hari\HariController;
use App\Http\Controllers\Kasir\Report\Jalan\JalanController;
use App\Http\Controllers\Kasir\Report\Juru\JuruParkirController as JuruJuruParkirController;
use App\Http\Controllers\Kasir\Report\Kolektor\KolektorController as KolektorKolektorController;
use App\Http\Controllers\Kolektor\KendaraanController;
use App\Http\Controllers\Kolektor\RegisterKolektorController;
use App\Http\Controllers\Kolektor\SetorController as KolektorSetorController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Super\JamController as SuperJamController;
use App\Http\Controllers\Super\KendaraanController as SuperKendaraanController;
use App\Http\Controllers\Super\ShiftController as SuperShiftController;
use App\Http\Controllers\Super\SuperadminController;
use App\Http\Controllers\Super\SuperkolektorController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ParkirController;
use App\Http\Controllers\User\SetorController;
use App\Http\Controllers\User\UpdateDataController;
use App\Http\Middleware\Superadmin;
use App\Models\Penghargaan;
use App\Models\Setor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/', [LandingController::class, 'index'])->name('login.index');

// status Akun Aktif atau Non-AKtif
Route::group(['middleware' => ['auth', 'checkUSerStatus']], function () {
    Route::get('user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    Route::get('kolektor/index', [kolektorController::class, 'index'])->name('kolektor.index');
});

Route::group(['middleware' => ['auth', 'check.complete']], function () {
    Route::get('user/parkir', [ParkirController::class, 'index'])->name('user.parkir');
});

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

    // data setor
    Route::get('kolektor/setor', [PembayaranController::class, 'index'])->name('kolektor.setor');
    Route::post('kolektor/setor-tambah', [PembayaranController::class, 'setoran'])->name('kolektor.setor-tambah');

    // data telah disetor
    Route::get('/kolektor/disetor', [KolektorSetorController::class, 'disetor'])->name('kolektor.disetor');
});

Route::middleware(['auth', 'kasir'])->namespace('kasir')->group(function () {
    Route::get('kasir/index', [IndexController::class, 'index'])->name('kasir.index');

    // data setoran dari kolektor
    Route::get('kasir/dataSetoran', [DataSetoranKolektorController::class, 'index'])->name('kasir.dataSetoran');
    Route::put('kasir/dataSetoran-status/{id}', [DataSetoranKolektorController::class, 'terima'])->name('kasir.dataSetoran.ubah');

    // langganan Parkir
    Route::get('kasir/inap', [PelangganController::class, 'index'])->name('kasir.inap');
    Route::post('kasir/inap/tambah', [PelangganController::class, 'tambah'])->name('kasir.inap.tambah');
    Route::put('kasir/inap/edit/{id}', [PelangganController::class, 'edit'])->name('kasir.inap.edit');
    Route::delete('kasir/inap/hapus/{id}', [PelangganController::class, 'hapus'])->name('kasir.inap.hapus');

    // inap
    Route::get('kasir/inap/tagih/{id}', [PelangganController::class, 'tagih'])->name('tagih.index');
    Route::get('kasir/cetak-inap/{id}', [PelangganController::class, 'cetakParkirInap']);

    // Report
    // Juru Parkir
    Route::get('kasir/juru-parkir', [JuruJuruParkirController::class, 'index'])->name('juru.parkir.index');
    Route::get('/get-lokasi-juru', [JuruJuruParkirController::class, 'getLokasiByUser'])->name('get.lokasi.juru');

    // Kolektor
    Route::get('kasir/report-kolektor', [KolektorKolektorController::class, 'index'])->name('kasir.report-kolektor');
    Route::get('/get-lokasi-kolektor', [KolektorKolektorController::class, 'getLokasiByUser'])->name('get.lokasi.kolektor');

    // Jalan
    Route::get('kasir/report-jalan', [JalanController::class, 'index'])->name('kasir.report-jalan');
    Route::get('/get-lokasi-jalan', [JalanController::class, 'getLokasiByUser'])->name('get.lokasi.jalan');

    // Hari
    Route::get('kasir/report-hari', [HariController::class, 'index'])->name('kasir.report-hari');
    Route::get('/get-lokasi-hari', [BulananController::class, 'getLokasiByUser'])->name('get.lokasi.hari');

    // Bulanan
    Route::get('kasir/report-bulanan', [BulananController::class, 'index'])->name('kasir.report-bulanan');
    Route::get('/get-lokasi-bulanan', [BulananController::class, 'getLokasiByUser'])->name('get.lokasi.bulanan');
});

Route::middleware(['auth', 'admin'])->namespace('admin')->group(function () {
    Route::get('admin/index', [AdminController::class, 'index'])->name('admin.index');

    // MENU
    Route::get('menu/index', [MenuController::class, 'index'])->name('menu.index');

    // Data Master
    // shift
    Route::get('admin/shift', [AdminShiftController::class, 'index'])->name('admin.shift');
    Route::post('admin/shift-tambah', [AdminShiftController::class, 'tambah'])->name('admin.shift-tambah');
    Route::put('admin/shift-edit/{id}', [AdminShiftController::class, 'edit'])->name('admin.shift-edit');
    Route::delete('admin/shift-hapus/{id}', [AdminShiftController::class, 'hapus'])->name('admin.shift-hapus');

    // Harga
    Route::get('admin/harga', [HargaController::class, 'index'])->name('admin.harga');
    Route::post('admin/harga-tambah', [HargaController::class, 'tambah'])->name('admin.harga-tambah');
    Route::put('admin/harga-edit/{id}', [HargaController::class, 'edit'])->name('admin.harga-edit');
    Route::delete('admin/harga-hapus/{id}', [HargaController::class, 'hapus'])->name('admin.harga-hapus');
    Route::get('/get-namaJalan/{id}', [HargaController::class, 'getNamaJalan'])->name('get-namaJln.kodeJln');
    Route::get('/cari-harga', [HargaController::class, 'cari'])->name('cari.harga');

    // lokasi
    Route::get('admin/lokasi', [AdminJamController::class, 'index'])->name('admin.lokasi');
    route::get('lokasi/cari', [AdminJamController::class, 'cari'])->name('admin.lokasi.cari');
    Route::post('admin/lokasi-tambah', [AdminJamController::class, 'tambah'])->name('admin.lokasi-tambah');
    Route::put('admin/lokasi-edit/{id}', [AdminJamController::class, 'edit'])->name('admin.lokasi-edit');
    Route::delete('admin/lokasi-hapus/{id}', [AdminJamController::class, 'hapus'])->name('admin.lokasi-hapus');
    Route::get('/get-kodeJln/{id}', [AdminJamController::class, 'getKodeJln'])->name('get-kodeJln');

    // Jalan
    Route::get('admin/jalan', [AdminJalanController::class, 'index'])->name('admin.jalan.index');
    Route::post('admin/jalan-tambah', [AdminJalanController::class, 'tambah'])->name('admin.jalan-tambah');
    Route::put('admin/jalan-edit/{id}', [AdminJalanController::class, 'edit'])->name('admin.jalan-edit');
    Route::delete('admin/jalan-hapus/{id}', [AdminJalanController::class, 'hapus'])->name('admin.jalan-hapus');

    Route::get('/otomatis/kodeJln', [AdminJalanController::class, 'getLastKodeJln']);

    // keterangan
    Route::get('admin/ket', [KetController::class, 'index'])->name('admin.ket');
    Route::post('admin/ket-tambah', [KetController::class, 'tambah'])->name('admin.ket-tambah');
    Route::put('admin/ket-edit/{id}', [KetController::class, 'edit'])->name('admin.ket-edit');
    Route::delete('admin/ket-hapus/{id}', [KetController::class, 'hapus'])->name('admin.ket-hapus');

    // karcis
    Route::get('admin/header', [HeaderController::class, 'index'])->name('admin.header.index');
    Route::post('admin/header-tambah', [HeaderController::class, 'tambah'])->name('admin.header-tambah');
    Route::put('admin/header-edit/{id}', [HeaderController::class, 'edit'])->name('admin.header-edit');
    Route::delete('admin/header-hapus/{id}', [HeaderController::class, 'hapus'])->name('admin.header-hapus');

    // pelanggan
    Route::get('admin/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan');

    // Akun
    Route::get('admin/akun', [AkunController::class, 'index'])->name('admin.akun');
    Route::post('status-Akun', [AkunController::class, 'statusAkun'])->name('statusAkun.update');
    Route::post('daftar/akun', [AkunController::class, 'daftar'])->name('daftar.akun');

    // Report
    Route::get('admin/report', [ReportController::class, 'index'])->name('admin.report');

    // Report Juru Parkir
    Route::get('admin/juru-parkir', [JuruController::class, 'index'])->name('admin.parkir.index');
    Route::get('/get-lokasi', [JuruController::class, 'getLokasi'])->name('get.lokasi.juru');

    // Report Kolektor
    Route::get('admin/kolek-report', [KolekController::class, 'index'])->name('admin.report-kolektor');
    Route::get('/get-lokasi-kolektor', [KolekController::class, 'getLokasi'])->name('get.lokasi.kolektor');

    // Report By jalan
    Route::get('admin/dalan-report', [DalanController::class, 'index'])->name('admin.report-dalan');
    Route::get('/get-lokasi-dalan', [DalanController::class, 'getLokasi'])->name('get.lokasi.kolektor');

    // Report By Hari
    Route::get('admin/report-day', [DayController::class, 'index'])->name('admin.report-day');
    Route::get('/get-lokasi-day', [DayController::class, 'getLokasi'])->name('get.lokasi.kolektor');

    // Report Bulan
    Route::get('admin/report-wulan', [WulanController::class, 'index'])->name('admin.report-wulan');
    Route::get('/get-lokasi-wulan', [WulanController::class, 'getLokasi'])->name('get.lokasi.kolektor');

    // pembayaran
    Route::get('admin/pembayaran', [AdminPembayaranController::class, 'index'])->name('admin.pembayaran');

    // kirim
    Route::get('admin/kirim', [KirimLaporanController::class, 'index'])->name('admin.kirim');

    // prediksi
    Route::get('admin/prediksi', [PrediksiController::class, 'index'])->name('admin.prediksi.index');
});

Route::middleware(['auth', 'superadmin'])->namespace('superadmin')->group(function () {
    Route::get('superadmin/index', [SuperadminController::class, 'index'])->name('superadmin.index');

    // shift
    Route::get('super/shift', [SuperShiftController::class, 'index'])->name('super.shift');
    Route::post('super/shift-tambah', [SuperShiftController::class, 'tambah'])->name('super.shift-tambah');
    Route::put('super/shift-edit/{id}', [SuperShiftController::class, 'edit'])->name('super.shift-edit');
    Route::delete('super/shift-hapus/{id}', [SuperShiftController::class, 'hapus'])->name('super.shift-hapus');

    // setting durasi parkir
    Route::get('super/jam', [SuperJamController::class, 'index'])->name('super.jam');
    Route::post('super/jam-tambah', [SuperJamController::class, 'tambah'])->name('super.jam-tambah');
    Route::put('super/jam-edit/{id}', [SuperJamController::class, 'edit'])->name('super.jam-edit');
    Route::delete('super/jam-hapus/{id}', [SuperJamController::class, 'hapus'])->name('super.jam-hapus');

    // durasi Parkir
    Route::get('super/jam-durasi/{tmptParkir}', [SuperJamController::class, 'getDurasiParkir']);

    Route::get('super/data-kendaraan', [SuperKendaraanController::class, 'index'])->name('super.data-kendaraan');
    Route::post('super/data-kendaraan-tambah', [SuperKendaraanController::class, 'tambah'])->name('super.data-kendaraan-tambah');
    Route::put('super/data-kendaraan-edit/{id}', [SuperKendaraanController::class, 'edit'])->name('super.data-kendaraan-edit');
    Route::delete('super/data-kendaraan-hapus/{id}', [SuperKendaraanController::class, 'hapus'])->name('super.data-kendaraan-hapus');

    // Route::get('super/setor', [KolektorSetorController::class, 'index'])->name('kolektor.setor');
    // Route::post('super/setor-tambah', [KolektorSetorController::class, 'setor'])->name('kolektor.setor-tambah');

    // // data telah disetor
    // Route::get('super/disetor', [KolektorSetorController::class, 'disetor'])->name('kolektor.disetor'); 
});

Route::get('login/index', [LoginController::class, 'index'])->name('login.index');
Route::post('login/store', [LoginController::class, 'store'])->name('login.store');

// Route::get('/register', [RegisterController::class, 'index'])->name('register.index');

Auth::routes();

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('user', function() {
//     $user = User::all();

//     return response()->json($user);

// });
