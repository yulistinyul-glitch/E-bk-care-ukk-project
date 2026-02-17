<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Siswa\DashboardSiswaController;    
use App\Http\Controllers\GuruBK\DashboardbkController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.select-roles'); 
})->name('choose.role');

Route::middleware('guest')->group(function () {
    Route::get('/login/{role}', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginProses'])->name('login.proses');

    //forgot password & otp
    Route::get('/forgot-password', function() { return view ('auth.forgot-password'); })->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'verifyAccount'])->name('password.verify');
    Route::get('/otp-verification', function() { return view('auth.otp-view'); })->name('otp.view');
    Route::post('/otp-verification', [AuthController::class, 'processOtp'])->name('otp.process');
});

Route::middleware('auth')->group(function () {
    
   
    Route::get('/new-password', [AuthController::class, 'showResetPage'])->name('password.new');
    Route::post('/save-password', [AuthController::class, 'savePassword'])->name('password.save');

 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //SISWA
    Route::middleware('role:Siswa')->group(function () {
        Route::get('/dashboard', [DashboardSiswaController::class, 'index'])->name('home');
        // Tambahkan route fitur siswa lainnya di sini
    });

    //GURU BK
    Route::middleware('role:GuruBK')->prefix('guru')->group(function () {
        Route::get('/dashboard', [DashboardbkController::class, 'index'])->name('gurubk.dashboard');
        
    });

    //ADMIN
    Route::middleware('role:Admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
       
    });
});