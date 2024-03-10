<?php


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
    Route::resource('/manage-pengajuan-cuti', Manage_pengajuan_cuti::class);
    Route::resource('/cuti-non-tahunan', Cuti_non::class);
    Route::resource('/konfigurasi-cuti', Konfigurasi_cuti::class);
    Route::resource('/manage-karyawan', Manage_karyawan::class);
    Route::get('/rekap-pengajuan-cuti', [Rekap_pengajuan_cuti::class,'index']);

});

//staf hr
Route::middleware(['authStafHR'])->prefix('pejabat-struktural')->group(function () {
    Route::get('/home', [Home::class,'index']);
    Route::resource('/manage-pengajuan-cuti', Manage_pengajuan_cuti::class);
    Route::resource('/cuti-non-tahunan', Cuti_non::class);
    Route::resource('/konfigurasi-cuti', Konfigurasi_cuti::class);
    Route::resource('/manage-karyawan', Manage_karyawan::class);
    Route::get('/rekap-pengajuan-cuti', [Rekap_pengajuan_cuti::class,'index']);

});

//karyawan
Route::middleware(['authKaryawan'])->prefix('karyawan')->group(function () {
    Route::get('/home', [Home::class,'index']);
    Route::post('/store-pengajuan', [Manage_pengajuan_cuti::class,'store']);
    Route::resource('/manage-pengajuan-cuti', Manage_pengajuan_cuti::class);
    Route::resource('/print-tahunan', Print_tahunan::class);
    Route::resource('/cuti-non-tahunan', Cuti_non::class);
    Route::resource('/print-non-tahunan', Print_non_tahunan::class);
    Route::post('/store-pengajuan-non', [Cuti_non::class,'store']);

});
