<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KotakSaranController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TentangController;
// SISWA, GURU, ADMIN


use App\Http\Controllers\Admin\AdminAuthController; 
use App\Http\Controllers\Siswa\SiswaAuthController;
use App\Http\Controllers\Gurubk\GuruAuthController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Siswa\DashboardSiswaController;
use App\Http\Controllers\Admin\GurubkController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\WalikelasController;
use App\Http\Controllers\Admin\PelanggaranController;
use App\Http\Controllers\Admin\TemplateSuratController;
use App\Http\Controllers\GuruBk\SiswaController as GuruBkSiswaController;
use App\Http\Controllers\GuruBk\SelfReportController;
use App\Http\Controllers\Gurubk\DashboardbkController;
use App\Http\Controllers\Gurubk\ChatController;
use App\Http\Controllers\Gurubk\E_SuratController;
use App\Http\Controllers\Gurubk\RiwayatPelanggaranController;
use Illuminate\Support\Facades\App;


// Mengarahkan ke view/tentang.blade.php melalui TentangController
Route::get('/home', function () { return view('home'); })->name('home');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang.index');

Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');

Route::get('/kotaksaran', [KotakSaranController::class, 'index'])->name('kotaksaran');

Route::get('/', function () {
    return view('auth.login'); 
})->name('login');
/*
|--------------------------------------------------------------------------
| ADMIN AUTH & FUNCTION
|--------------------------------------------------------------------------
*/


Route::prefix('admin')->name('admin.')->group(function () {

<<<<<<< HEAD
    Route::middleware('guest')->group(function() {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit'); 
    });

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])->name('dashboard');


    Route::get('siswa/history', [SiswaController::class, 'history'])
        ->name('siswa.history');

    Route::get('siswa/cetak-semua', [SiswaController::class, 'cetakSemua'])
        ->name('siswa.cetak.semua');

    Route::post('siswa/import', [SiswaController::class, 'import'])
        ->name('siswa.import');

  
    Route::post('siswa/{id}/restore', [SiswaController::class, 'restore'])
        ->name('siswa.restore');

    // 3. Resource Route
    // Tetap gunakan 'siswa' sebagai nama resource
=======
    Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])
        ->name('dashboard');
Route::get('siswa/history', [SiswaController::class, 'history'])->name('siswa.history');
    Route::post('siswa/{id}/restore', [SiswaController::class, 'restore'])->name('siswa.restore');
    Route::delete('siswa/{id}/force-delete', [SiswaController::class, 'forceDelete'])->name('siswa.forceDelete');
    Route::get('siswa/cetak-semua', [SiswaController::class, 'cetakSemua'])->name('siswa.cetak.semua');
    Route::post('siswa/import', [SiswaController::class, 'import'])->name('siswa.import');

    // Resource Route (Otomatis mencakup index, create, store, edit, update, destroy)
>>>>>>> 098a2476afb3c6d271f5c6d5d0ee5e4dc20902d5
    Route::resource('siswa', SiswaController::class);

    Route::resource('kelas', KelasController::class);

    Route::resource('template_surats', TemplateSuratController::class);

    Route::resource('gurubk', GurubkController::class);

    Route::post('walikelas/import',
        [WalikelasController::class, 'import']
    )->name('walikelas.import');

    Route::get('walikelas/cetak-semua',
        [WalikelasController::class, 'cetakSemua']
    )->name('walikelas.cetak.semua');

    Route::resource('walikelas', WalikelasController::class);

    Route::get('pelanggaran/import',
        [PelanggaranController::class, 'importForm']
    )->name('pelanggaran.import.form');

    Route::post('pelanggaran/import',
        [PelanggaranController::class, 'import']
    )->name('pelanggaran.import');

    Route::get('pelanggaran/history', [PelanggaranController::class, 'history'])->name('pelanggaran.history');
    Route::post('pelanggaran/{id}/restore', [PelanggaranController::class, 'restore'])->name('pelanggaran.restore');
    Route::delete('pelanggaran/{id}/force-delete', [PelanggaranController::class, 'forceDelete'])->name('pelanggaran.forceDelete');

    Route::resource('pelanggaran', PelanggaranController::class);
    });

});

/*
|--------------------------------------------------------------------------
| GURU BK ROUTES
|--------------------------------------------------------------------------
*/
// 1. Rute LOGIN (Bisa diakses tanpa login)
Route::prefix('gurubk')->name('gurubk.')->group(function () {
    Route::get('/login', [GuruAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [GuruAuthController::class, 'login'])->name('login.submit');
});

// 2. Rute FITUR (Wajib Login & Role GuruBK)
Route::middleware(['auth', 'role:GuruBK'])->prefix('gurubk')->name('gurubk.')->group(function () {
    
    // Dashboard & Chat
    Route::get('/dashboard', [DashboardbkController::class, 'dashboard'])->name('dashboard');
    Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('chat/{id}/reply', [ChatController::class, 'reply'])->name('chat.reply');
    Route::post('chat/{id}/read', [ChatController::class, 'markRead'])->name('chat.read');

    // Riwayat Pelanggaran
    Route::get('/get-siswa/{id_kelas}', [RiwayatPelanggaranController::class, 'getSiswa'])->name('riwayatpelanggaran.getSiswa'); 
    Route::get('/get-pelanggaran/{id}', [RiwayatPelanggaranController::class, 'getPelanggaran'])->name('riwayatpelanggaran.getPelanggaran'); 
    Route::post('/riwayatpelanggaran/store', [RiwayatPelanggaranController::class, 'store'])->name('riwayatpelanggaran.store'); 
    Route::resource('riwayatpelanggaran', RiwayatPelanggaranController::class);

    // Self Report
    Route::prefix('selfreport')->name('selfreport.')->group(function () {
        Route::get('/', [SelfReportController::class, 'index'])->name('index');
        Route::get('/arsip', [SelfReportController::class, 'arsip'])->name('arsip');
        Route::get('/{id}', [SelfReportController::class, 'show'])->name('show');
    });

    // Data Siswa
    Route::get('/siswa/cetak/semua', [GuruBkSiswaController::class, 'cetakSemua'])->name('siswa.cetak.semua');
    Route::get('/siswa', [GuruBkSiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/{id}', [GuruBkSiswaController::class, 'show'])->name('siswa.show');

    // E-Surat
    Route::get('e_surat/{id}/export', [E_SuratController::class, 'export'])->name('e_surat.export');
    Route::get('e_surat/{id}/email', [E_SuratController::class, 'sendEmail'])->name('e_surat.email');
    Route::get('e_surat/{id}/selesai', [E_SuratController::class, 'selesai'])->name('e_surat.selesai');
    Route::resource('e_surat', E_SuratController::class)->except(['destroy']);
    
    // Logout
    Route::post('/logout', [GuruAuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| SISWA ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->name('siswa.')->group(function () {
    // --- AUTH SISWA ---
    Route::get('/login', [SiswaAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SiswaAuthController::class, 'login'])->name('login.submit');

    Route::get('/forgot-password', [SiswaAuthController::class, 'showForgotForm'])->name('forgot-password');
    Route::post('/forgot-password', [SiswaAuthController::class, 'sendOtp'])->name('forgot-password.submit');

    Route::get('/verify-otp/{username}', [SiswaAuthController::class, 'showVerifyOtpForm'])->name('verify-otp-page');
    Route::post('/verify-code', [SiswaAuthController::class, 'checkOtp'])->name('verify-code.submit');

    Route::get('/reset-password/{username}/{otp}', [SiswaAuthController::class, 'showResetPasswordForm'])->name('reset-password');
    Route::post('/reset-password', [SiswaAuthController::class, 'verifyOtp'])->name('reset-password.submit'); 
    
    Route::middleware(['auth', 'role:Siswa'])->group(function () {
        Route::get('/setup-password', [SiswaAuthController::class, 'showSetupForm'])->name('setup-password');
        Route::post('/update-setup-password', [SiswaAuthController::class, 'updatePassword'])->name('update-password');
        
        Route::get('/home', function() { return view('siswa.home'); })->name('home');
    });
});
