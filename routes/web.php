<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;

use App\Http\Controllers\LayananController;
use App\Http\Controllers\TentangController;

// Mengarahkan ke view/tentang.blade.php melalui TentangController
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang.index');

Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
/*

|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\GurubkController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\WalikelasController;
use App\Http\Controllers\Admin\PelanggaranController;
use App\Http\Controllers\Admin\TemplateSuratController;

/*
|--------------------------------------------------------------------------
| GURU BK CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\GuruBk\SiswaController as GuruBkSiswaController;
use App\Http\Controllers\GuruBk\SelfReportController;
use App\Http\Controllers\Gurubk\DashboardbkController;
use App\Http\Controllers\Gurubk\ChatController;
use App\Http\Controllers\Gurubk\E_SuratController;
use App\Http\Controllers\Gurubk\RiwayatPelanggaranController;


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

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

    Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | SISWA (FIX ORDER - IMPORTANT)
    |--------------------------------------------------------------------------
    */

    Route::get('siswa/cetak-semua',
        [SiswaController::class, 'cetakSemua']
    )->name('siswa.cetak.semua');

    Route::post('siswa/import',
        [SiswaController::class, 'import']
    )->name('siswa.import');

    Route::resource('siswa', SiswaController::class)
        ->except(['show']); // Hapus show jika tidak dipakai


    /*
    |--------------------------------------------------------------------------
    | KELAS
    |--------------------------------------------------------------------------
    */

    Route::resource('kelas', KelasController::class);


    /*
    |--------------------------------------------------------------------------
    | TEMPLATE SURAT
    |--------------------------------------------------------------------------
    */

    Route::resource('template_surats', TemplateSuratController::class);


    /*
    |--------------------------------------------------------------------------
    | GURU BK
    |--------------------------------------------------------------------------
    */

    Route::resource('gurubk', GurubkController::class);


    /*
    |--------------------------------------------------------------------------
    | WALIKELAS
    |--------------------------------------------------------------------------
    */

    Route::post('walikelas/import',
        [WalikelasController::class, 'import']
    )->name('walikelas.import');

    Route::get('walikelas/cetak-semua',
        [WalikelasController::class, 'cetakSemua']
    )->name('walikelas.cetak.semua');

    Route::resource('walikelas', WalikelasController::class);


    /*
    |--------------------------------------------------------------------------
    | PELANGGARAN
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | CHAT
    |--------------------------------------------------------------------------
    */

    Route::get('chat', [ChatController::class,'index'])->name('chat.index');
    Route::post('chat/{id}/reply', [ChatController::class,'reply'])->name('chat.reply');
    Route::post('chat/{id}/read', [ChatController::class,'markRead'])->name('chat.read');


    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PELANGGARAN
    |--------------------------------------------------------------------------
    */

    Route::get('/get-siswa/{id_kelas}',
        [RiwayatPelanggaranController::class, 'getSiswa']);

    Route::get('/get-pelanggaran/{id}',
        [RiwayatPelanggaranController::class, 'getPelanggaran']);

    Route::post('/riwayatpelanggaran/store',
        [RiwayatPelanggaranController::class, 'store'])
        ->name('riwayatpelanggaran.store');

    Route::resource('riwayatpelanggaran',
        RiwayatPelanggaranController::class)
        ->except(['create','edit']);


    /*
    |--------------------------------------------------------------------------
    | SELF REPORT
    |--------------------------------------------------------------------------
    */

    Route::prefix('selfreport')->name('selfreport.')->group(function () {

        Route::get('/', [SelfReportController::class, 'index'])
            ->name('index');

        Route::get('/arsip', [SelfReportController::class, 'arsip'])
            ->name('arsip');

        Route::get('/{id}', [SelfReportController::class, 'show'])
            ->name('show');
    });


    /*
    |--------------------------------------------------------------------------
    | SISWA (FIX ORDER)
    |--------------------------------------------------------------------------
    */

    Route::get('/siswa/cetak/semua',
        [GuruBkSiswaController::class, 'cetakSemua'])
        ->name('siswa.cetak.semua');

    Route::get('/siswa',
        [GuruBkSiswaController::class, 'index'])
        ->name('siswa.index');

    Route::get('/siswa/{id}',
        [GuruBkSiswaController::class, 'show'])
        ->name('siswa.show');


    /*
    |--------------------------------------------------------------------------
    | E-SURAT
    |--------------------------------------------------------------------------
    */

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
