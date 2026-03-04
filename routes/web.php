<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KotakSaranController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TentangController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\GurubkController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\WalikelasController;
use App\Http\Controllers\Admin\PelanggaranController;
use App\Http\Controllers\Admin\TemplateSuratController;
use App\Http\Controllers\Admin\LogAktivitasController;

// Guru BK Controllers
use App\Http\Controllers\GuruBk\SiswaController as GuruBkSiswaController;
use App\Http\Controllers\GuruBk\SelfReportController;
use App\Http\Controllers\Gurubk\DashboardbkController;
use App\Http\Controllers\Gurubk\ChatController;
use App\Http\Controllers\Gurubk\E_SuratController;
use App\Http\Controllers\Gurubk\RiwayatPelanggaranController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [AuthController::class, 'showLogin'])->name('login'); // Satu-satunya route dengan nama 'login'
Route::get('/home', function () { return view('home'); });
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang.index');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/kotaksaran', [KotakSaranController::class, 'index'])->name('kotaksaran');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/login/{role}', [AuthController::class, 'login'])->name('login.role'); // Nama diubah agar tidak bentrok
Route::post('/login-proses', [AuthController::class, 'loginProses'])->name('login.proses');
Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])->name('dashboard');
    
    // Siswa
    Route::get('siswa/history', [SiswaController::class, 'history'])->name('siswa.history');
    Route::post('siswa/{id}/restore', [SiswaController::class, 'restore'])->name('siswa.restore');
    Route::delete('siswa/{id}/force-delete', [SiswaController::class, 'forceDelete'])->name('siswa.forceDelete');
    Route::get('siswa/cetak-semua', [SiswaController::class, 'cetakSemua'])->name('siswa.cetak.semua');
    Route::post('siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    Route::resource('siswa', SiswaController::class);

    Route::resource('kelas', KelasController::class);
    Route::resource('gurubk', GurubkController::class);

    // Template Surat
    Route::get('template_surats/history', [TemplateSuratController::class, 'history'])->name('template_surats.history');
    Route::post('template_surats/{id}/restore', [TemplateSuratController::class, 'restore'])->name('template_surats.restore');
    Route::delete('template_surats/{id}/force-delete', [TemplateSuratController::class, 'forceDelete'])->name('template_surats.forceDelete');
    Route::resource('template_surats', TemplateSuratController::class)->parameters(['template_surats' => 'id']);
    Route::get('template_surats/{id}/download', [TemplateSuratController::class, 'download'])
        ->name('template_surats.download');

    // Walikelas
    Route::post('walikelas/import', [WalikelasController::class, 'import'])->name('walikelas.import');
    Route::get('walikelas/cetak-semua', [WalikelasController::class, 'cetakSemua'])->name('walikelas.cetak.semua');
    Route::resource('walikelas', WalikelasController::class);

    // Pelanggaran
    Route::get('pelanggaran/history', [PelanggaranController::class, 'history'])->name('pelanggaran.history');
    Route::get('pelanggaran/import', [PelanggaranController::class, 'importForm'])->name('pelanggaran.import.form');
    Route::post('pelanggaran/import', [PelanggaranController::class, 'import'])->name('pelanggaran.import');
    Route::post('pelanggaran/{id}/restore', [PelanggaranController::class, 'restore'])->name('pelanggaran.restore');
    Route::delete('pelanggaran/{id}/force-delete', [PelanggaranController::class, 'forceDelete'])->name('pelanggaran.forceDelete');
    Route::resource('pelanggaran', PelanggaranController::class);
Route::get('/monitoring/log', [LogAktivitasController::class, 'indexLog'])->name('log');
});

/*
|--------------------------------------------------------------------------
| GURU BK ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('gurubk')->name('gurubk.')->group(function () {
    Route::get('/dashboard', [DashboardbkController::class, 'dashboard'])->name('dashboard');

    Route::get('chat', [ChatController::class,'index'])->name('chat.index');
    Route::post('chat/{id}/reply', [ChatController::class,'reply'])->name('chat.reply');
    Route::post('chat/{id}/read', [ChatController::class,'markRead'])->name('chat.read');

    Route::get('/get-siswa/{id_kelas}', [RiwayatPelanggaranController::class, 'getSiswa'])->name('riwayatpelanggaran.getSiswa'); 
    Route::get('/get-pelanggaran/{id}', [RiwayatPelanggaranController::class, 'getPelanggaran'])->name('riwayatpelanggaran.getPelanggaran'); 
    Route::post('/riwayatpelanggaran/store', [RiwayatPelanggaranController::class, 'store'])->name('riwayatpelanggaran.store'); 
    Route::resource('riwayatpelanggaran', RiwayatPelanggaranController::class);

    Route::prefix('selfreport')->name('selfreport.')->group(function () {
        Route::get('/', [SelfReportController::class, 'index'])->name('index');
        Route::get('/arsip', [SelfReportController::class, 'arsip'])->name('arsip');
        Route::get('/{id}', [SelfReportController::class, 'show'])->name('show');
    });

    Route::get('/siswa', [GuruBkSiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/cetak/semua', [GuruBkSiswaController::class, 'cetakSemua'])->name('siswa.cetak.semua');
    Route::get('/siswa/{id}', [GuruBkSiswaController::class, 'show'])->name('siswa.show');

Route::get('e_surat/{id}/print-pdf', [E_SuratController::class, 'print_pdf'])->name('e_surat.print_pdf');
    Route::post('e_surat/{id}/send-email', [E_SuratController::class, 'send_email'])->name('e_surat.send_email');
    Route::get('e_surat/{id}/export-word', [E_SuratController::class, 'export'])->name('e_surat.export');

    // Route Resource (Otomatis: index, store, dll)
    Route::resource('e_surat', E_SuratController::class)->except(['destroy']);

});

/*
|--------------------------------------------------------------------------
| SISWA ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', function () { return view('siswa.home'); })->name('home');
});