<?php

use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/select-role', function () { return view('login.select-roles'); })->name('role.select');

//alur login
Route::get('/login/siswa', function () { return view('login.login'); })->name('login.siswa');
Route::post('/login/proses', [AuthController::class, 'loginProses'])->name('login.post');

//forgot password
Route::get('/forgot-password', function () { return view('login.forgetpw'); })->name('password.forgot');
//Cek NIPD
Route::post('/forgot-password/verify', [AuthController::class, 'verifyAccount'])->name('password.verify');

//kode otp
Route::get('/verify-otp', function () { return view('login.verify-code'); })->name('otp.view');
Route::post('/verify-otp', [AuthController::class, 'processOtp'])->name('otp.post');

Route::get('/reset-password', [AuthController::class, 'showResetPage'])->name('password.new');

Route::post('/simpan-password', [AuthController::class, 'savePassword'])->name('password.save');


Route::middleware('auth')->group(function () {
    //dasboard
    Route::get('/home', function () { return view('home'); })->name('home');
});

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//
Route::get('/profile', function () { return view('profile'); })->name('profile');