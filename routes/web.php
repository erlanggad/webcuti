<?php

use App\Http\Controllers\CriteriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Register;
use App\Http\Controllers\Home;
use App\Http\Controllers\Konfigurasi_cuti;
use App\Http\Controllers\Manage_karyawan;
use App\Http\Controllers\Manage_staf_hr;
use App\Http\Controllers\Manage_pengajuan_cuti;
use App\Http\Controllers\Rekap_pengajuan_cuti;
use App\Http\Controllers\Cuti_non;
use App\Http\Controllers\Forgot_Password;
use App\Http\Controllers\PerhitunganWaspasController;
use App\Http\Controllers\Print_tahunan;
use App\Http\Controllers\Print_non_tahunan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Login::class,'index']);
Route::get('/login', [Login::class,'index']);
Route::post('/login-action', [Login::class,'login_action']);
Route::get('/register', [Register::class,'index']);
Route::post('/store-register', [Register::class,'store']);
Route::get('/logout-action', [Login::class,'logout_action']);
Route::get('/forgot-password', [Forgot_Password::class,'index']);
// Route untuk mengirim email dengan OTP
Route::post('/forgot-password-action', [Forgot_Password::class,'sendOTP']);

// Route untuk menampilkan form input OTP
Route::get('/verify-otp', [Forgot_Password::class,'showOTPForm'])->name('verify-otp');
// Route untuk memverifikasi OTP
Route::get('/verify-otp-action', [Forgot_Password::class,'verifyOTP']);

// Route untuk menampilkan form input password baru
Route::get('/reset-password', [Forgot_Password::class,'showResetPasswordForm'])->name('reset-password');
// Route untuk menyimpan password baru
Route::post('/reset-password-action', [Forgot_Password::class,'resetPassword']);
// Route::post('/store-register', [Register::class,'store']);
//admin
Route::middleware(['authAdmin'])->prefix('admin')->group(function () {
    Route::get('/home', [Home::class,'index']);
    Route::resource('/manage-pejabat-struktural', Manage_staf_hr::class);
    // Route::resource('/manage-pengajuan-cuti', Manage_pengajuan_cuti::class);
    Route::get('/manage-pengajuan-cuti', [Manage_pengajuan_cuti::class, 'index'])->name('manage_pengajuan_cuti.indexAdmin');

// Route untuk menyimpan data pengajuan cuti
Route::post('/manage-pengajuan-cuti', [Manage_pengajuan_cuti::class, 'store'])->name('manage_pengajuan_cuti.store');

// Route untuk menampilkan halaman form pengajuan cuti
Route::get('/manage-pengajuan-cuti/create', [Manage_pengajuan_cuti::class, 'create'])->name('manage_pengajuan_cuti.create');

// Route untuk menampilkan halaman edit pengajuan cuti
Route::get('/manage-pengajuan-cuti/{id_pengajuan_cuti}/edit', [Manage_pengajuan_cuti::class, 'edit'])->name('manage_pengajuan_cuti.edit');

// Route untuk mengupdate data pengajuan cuti
Route::put('/manage-pengajuan-cuti/{id_pengajuan_cuti}', [Manage_pengajuan_cuti::class, 'update'])->name('manage_pengajuan_cuti.update');

// Route untuk menghapus data pengajuan cuti
Route::delete('/manage-pengajuan-cuti/{id_pengajuan_cuti}', [Manage_pengajuan_cuti::class, 'destroy'])->name('manage_pengajuan_cuti.destroy');

// Route untuk menampilkan halaman print
Route::get('/manage-pengajuan-cuti/{id_pengajuan_cuti}/print', [Manage_pengajuan_cuti::class, 'print'])->name('manage_pengajuan_cuti.print');

// Route untuk menampilkan halaman detail pengajuan cuti
Route::get('/manage-pengajuan-cuti/{id_pengajuan_cuti}', [Manage_pengajuan_cuti::class, 'show'])->name('manage_pengajuan_cuti.show');
    Route::resource('/cuti-non-tahunan', Cuti_non::class);
    Route::resource('/konfigurasi-cuti', Konfigurasi_cuti::class);
    Route::resource('/manage-karyawan', Manage_karyawan::class);
    Route::get('/rekap-pengajuan-cuti', [Rekap_pengajuan_cuti::class,'index']);
    Route::resource('/kriteria', CriteriaController::class);
    Route::get('konversi-pengajuan-cuti/{jenis}', [PerhitunganWaspasController::class,'index']);
    Route::get('normalisasi-pengajuan-cuti/{jenis}', [PerhitunganWaspasController::class,'normalisasi']);
    Route::get('hasil-akhir-pengajuan-cuti/{jenis}', [PerhitunganWaspasController::class,'hasil_akhir']);




});

//staf hr
Route::middleware(['authStafHR'])->prefix('pejabat-struktural')->group(function () {
    Route::get('/home', [Home::class,'index']);
    // Route::resource('/manage-pengajuan-cuti', Manage_pengajuan_cuti::class);
    // Route::get('/manage-pengajuan-cuti', [Manage_pengajuan_cuti::class, 'index_pengelolaa'])->name('manage_pengajuan_cuti.index_pengelolaa');
    // Route::resource('/cuti-non-tahunan', Cuti_non::class);

    // Route untuk menampilkan halaman index pengelola
Route::get('/manage-pengajuan-cuti', [Manage_pengajuan_cuti::class, 'index'])->name('manage_pengajuan_cuti.indexManager');

// Route untuk menyimpan data pengajuan cuti
Route::post('/manage-pengajuan-cuti', [Manage_pengajuan_cuti::class, 'store'])->name('manage_pengajuan_cuti.store');

// Route untuk menampilkan halaman form pengajuan cuti
Route::get('/manage-pengajuan-cuti/create', [Manage_pengajuan_cuti::class, 'create'])->name('manage_pengajuan_cuti.create');

// Route untuk menampilkan halaman edit pengajuan cuti
Route::get('/manage-pengajuan-cuti/{id_pengajuan_cuti}/edit', [Manage_pengajuan_cuti::class, 'edit'])->name('manage_pengajuan_cuti.edit');

// Route untuk mengupdate data pengajuan cuti
Route::put('/manage-pengajuan-cuti/{id_pengajuan_cuti}', [Manage_pengajuan_cuti::class, 'update'])->name('manage_pengajuan_cuti.update');

// Route untuk menghapus data pengajuan cuti
Route::delete('/manage-pengajuan-cuti/{id_pengajuan_cuti}', [Manage_pengajuan_cuti::class, 'destroy'])->name('manage_pengajuan_cuti.destroy');

// Route untuk menampilkan halaman print
Route::get('/manage-pengajuan-cuti/{id_pengajuan_cuti}/print', [Manage_pengajuan_cuti::class, 'print'])->name('manage_pengajuan_cuti.print');

// Route untuk menampilkan halaman detail pengajuan cuti
Route::get('/manage-pengajuan-cuti/{id_pengajuan_cuti}', [Manage_pengajuan_cuti::class, 'show'])->name('manage_pengajuan_cuti.show');

    Route::resource('/konfigurasi-cuti', Konfigurasi_cuti::class);
    Route::resource('/manage-karyawan', Manage_karyawan::class);
    // Route::get('/rekap-pengajuan-cuti', [Rekap_pengajuan_cuti::class,'index']);
    Route::get('/rekap-pengajuan-cuti', [Rekap_pengajuan_cuti::class, 'index'])->name('rekap_pengajuan_cuti.index');

    Route::get('konversi-pengajuan-cuti/{jenis}', [PerhitunganWaspasController::class,'index']);
    Route::get('normalisasi-pengajuan-cuti/{jenis}', [PerhitunganWaspasController::class,'normalisasi']);
    Route::get('hasil-akhir-pengajuan-cuti/{jenis}', [PerhitunganWaspasController::class,'hasil_akhir']);

});

//karyawan
Route::middleware(['authKaryawan'])->prefix('karyawan')->group(function () {
    Route::get('/home', [Home::class,'index']);
    Route::post('/store-pengajuan', [Manage_pengajuan_cuti::class,'store']);
    // Route::resource('/manage-pengajuan-cuti', Manage_pengajuan_cuti::class);

    Route::get('/manage-pengajuan-cuti', [Manage_pengajuan_cuti::class, 'index'])->name('manage_pengajuan_cuti.indexKaryawan');

    // Route untuk menyimpan data pengajuan cuti
    Route::post('/manage-pengajuan-cuti', [Manage_pengajuan_cuti::class, 'store'])->name('manage_pengajuan_cuti.store');

    // Route untuk menampilkan halaman form pengajuan cuti
    Route::get('/manage-pengajuan-cuti/create', [Manage_pengajuan_cuti::class, 'create'])->name('manage_pengajuan_cuti.create');

    // Route untuk menampilkan halaman edit pengajuan cuti
    Route::get('/manage-pengajuan-cuti/{id_pengajuan_cuti}/edit', [Manage_pengajuan_cuti::class, 'edit'])->name('manage_pengajuan_cuti.edit');

    // Route untuk mengupdate data pengajuan cuti
    Route::put('/manage-pengajuan-cuti/{id_pengajuan_cuti}', [Manage_pengajuan_cuti::class, 'update'])->name('manage_pengajuan_cuti.update');

    // Route untuk menghapus data pengajuan cuti
    Route::delete('/manage-pengajuan-cuti/{id_pengajuan_cuti}', [Manage_pengajuan_cuti::class, 'destroy'])->name('manage_pengajuan_cuti.destroy');

    // Route untuk menampilkan halaman print
    Route::get('/manage-pengajuan-cuti/{id_pengajuan_cuti}/print', [Manage_pengajuan_cuti::class, 'print'])->name('manage_pengajuan_cuti.print');

    // Route untuk menampilkan halaman detail pengajuan cuti
    Route::get('/manage-pengajuan-cuti/{id_pengajuan_cuti}', [Manage_pengajuan_cuti::class, 'show'])->name('manage_pengajuan_cuti.show');
    Route::resource('/print-tahunan', Print_tahunan::class);
    Route::resource('/cuti-non-tahunan', Cuti_non::class);
    Route::resource('/print-non-tahunan', Print_non_tahunan::class);
    Route::post('/store-pengajuan-non', [Cuti_non::class,'store']);

});

Route::get('/urgensi_cuti_detail/{id}', [Cuti_non::class, 'getUrgensiCuti']);
