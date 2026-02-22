<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KotakSaranController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TentangController;

Route::get('/tentang', [TentangController::class, 'index'])->name('tentang.index');

Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');

Route::get('/kotaksaran', [KotakSaranController::class, 'index'])->name('kotaksaran');

use App\Http\Controllers\Admin\DashboardAdminController;
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


Route::get('/home', function () {
    return view('home');
});

Route::get('/', function () {
    return view('auth.login'); 
})->name('login');

Route::get('/login/{role}', [AuthController::class, 'login'])->name('login');
Route::post('/login-proses', [AuthController::class, 'loginProses'])->name('login.proses');

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])
        ->name('dashboard');

// 1. Rute Khusus (Wajib di atas Resource)
    Route::get('siswa/history', [SiswaController::class, 'history'])
        ->name('siswa.history');

    Route::get('siswa/cetak-semua', [SiswaController::class, 'cetakSemua'])
        ->name('siswa.cetak.semua');

    Route::post('siswa/import', [SiswaController::class, 'import'])
        ->name('siswa.import');

    // 2. Rute untuk Restore & Force Delete (Jika diperlukan nanti)
    Route::post('siswa/{id}/restore', [SiswaController::class, 'restore'])
        ->name('siswa.restore');

    // 3. Resource Route
    // Tetap gunakan 'siswa' sebagai nama resource
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

    Route::resource('pelanggaran', PelanggaranController::class);
});


/*
|--------------------------------------------------------------------------
| GURU BK ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('gurubk')->name('gurubk.')->group(function () {

    Route::get('/dashboard', [DashboardbkController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('chat', [ChatController::class,'index'])->name('chat.index');
    Route::post('chat/{id}/reply', [ChatController::class,'reply'])->name('chat.reply');
    Route::post('chat/{id}/read', [ChatController::class,'markRead'])->name('chat.read');

    Route::get('/get-siswa/{id_kelas}', [RiwayatPelanggaranController::class, 'getSiswa']) ->name('gurubk.riwayatpelanggaran.getSiswa'); 
    Route::get('/get-pelanggaran/{id}', [RiwayatPelanggaranController::class, 'getPelanggaran']) ->name('gurubk.riwayatpelanggaran.getPelanggaran'); 
    Route::post('/riwayatpelanggaran/store', [RiwayatPelanggaranController::class, 'store']) ->name('gurubk.riwayatpelanggaran.store'); 
    Route::resource('riwayatpelanggaran', RiwayatPelanggaranController::class);

    Route::prefix('selfreport')->name('selfreport.')->group(function () {

        Route::get('/', [SelfReportController::class, 'index'])
            ->name('index');

        Route::get('/arsip', [SelfReportController::class, 'arsip'])
            ->name('arsip');

        Route::get('/{id}', [SelfReportController::class, 'show'])
            ->name('show');
    });

    Route::get('/siswa/cetak/semua',
        [GuruBkSiswaController::class, 'cetakSemua'])
        ->name('siswa.cetak.semua');

    Route::get('/siswa',
        [GuruBkSiswaController::class, 'index'])
        ->name('siswa.index');

    Route::get('/siswa/{id}',
        [GuruBkSiswaController::class, 'show'])
        ->name('siswa.show');

    Route::get('e_surat/{id}/export',
        [E_SuratController::class, 'export'])
        ->name('e_surat.export');

    Route::get('e_surat/{id}/email',
        [E_SuratController::class, 'sendEmail'])
        ->name('e_surat.email');

    Route::get('e_surat/{id}/selesai',
        [E_SuratController::class, 'selesai'])
        ->name('e_surat.selesai');

    Route::resource('e_surat', E_SuratController::class)
        ->except(['destroy']);
});

/*
|--------------------------------------------------------------------------
| SISWA ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', function () {
        return view('siswa.home');
    })->name('home');
});