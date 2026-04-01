<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KotakSaranController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LaporanBulananController;
// SISWA, GURU, ADMIN


use App\Http\Controllers\Admin\AdminAuthController; 
use App\Http\Controllers\Siswa\SiswaAuthController;
use App\Http\Controllers\Gurubk\GuruAuthController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Siswa\DashboardSiswaController;
use App\Http\Controllers\Admin\AutentikasiController;
use App\Http\Controllers\Admin\GurubkController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\WalikelasController;
use App\Http\Controllers\Admin\PelanggaranController;
use App\Http\Controllers\Admin\TemplateSuratController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\TentangController as AdminTentangController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\LayananController as AdminLayananController;
use App\Http\Controllers\Admin\SaranController as AdminSaranController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;

// Guru BK Controllers
use App\Http\Controllers\GuruBk\SiswaController as GuruBkSiswaController;
use App\Http\Controllers\GuruBk\SelfReportController;
use App\Http\Controllers\Gurubk\DashboardbkController;
use App\Http\Controllers\Gurubk\ChatController;
use App\Http\Controllers\Gurubk\E_SuratController;
use App\Http\Controllers\Gurubk\KonselingController;
use App\Http\Controllers\Gurubk\RiwayatPelanggaranController;
use App\Http\Controllers\Gurubk\SaranController;
use App\Http\Controllers\Siswa\KonselingSiswaController;
use App\Http\Controllers\Siswa\KotakSuratController;
use App\Http\Controllers\Siswa\SaranSiswaController;
use App\Http\Controllers\Siswa\SelfReportSiswaController;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang.index');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/kotaksaran', [KotakSaranController::class, 'index'])->name('kotaksaran');

Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit'); 

        Route::get('/autentikasi', [AutentikasiController::class, 'index'])->name('autentikasi');
       Route::post('/autentikasi/logout/{id}', [AutentikasiController::class, 'forceLogout'])->name('forceLogout');
        
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])->name('dashboard');
        

      Route::get('/laporan', [LaporanBulananController::class, 'adminIndex'])->name('admin.laporan.index');
    Route::post('/laporan/{laporan}/update-status', [LaporanBulananController::class, 'adminUpdateStatus'])->name('admin.laporan.update_status');

    Route::get('/data/tentang', [AdminTentangController::class, 'edit'])->name('tentang.edit');
        Route::put('/data/tentang/update', [AdminTentangController::class, 'update'])->name('tentang.update'); 

    Route::get('data/artikel', [AdminArtikelController::class, 'index'])->name('data.artikel.index');
        Route::post('data/artikel', [AdminArtikelController::class, 'store'])->name('data.artikel.store');
        Route::put('data/artikel/{id}', [AdminArtikelController::class, 'update'])->name('data.artikel.update');
        Route::delete('data/artikel/{id}', [AdminArtikelController::class, 'destroy'])->name('data.artikel.destroy');

    Route::get('/data/kotaksaran', [AdminSaranController::class, 'index'])->name('data.kotaksaran');
    Route::post('/data/kotaksaran', [AdminSaranController::class, 'store'])->name('data.kotaksaran.store');
    Route::put('/data/kotaksaran/{id}', [AdminSaranController::class, 'update'])->name('data.kotaksaran.update');
    Route::delete('/data/kotaksaran/{id}', [AdminSaranController::class, 'destroy'])->name('data.kotaksaran.destroy');

    Route::get('/data/layanan', [AdminLayananController::class, 'index'])->name('layanan.index');
    Route::post('/data/layanan', [AdminLayananController::class, 'store'])->name('layanan.store');
    Route::put('/data/layanan/{id}', [AdminLayananController::class, 'update'])->name('layanan.update');
    Route::delete('/data/layanan/{id}', [AdminLayananController::class, 'destroy'])->name('layanan.destroy');

Route::resource('data/galeri', AdminGaleriController::class)->names([
    'index'   => 'data.galeri.index',
    'create'  => 'data.galeri.create',
    'store'   => 'data.galeri.store',
    'show'    => 'data.galeri.show',
    'edit'    => 'data.galeri.edit',
    'update'  => 'data.galeri.update',
    'destroy' => 'data.galeri.destroy',
]);

Route::get('siswa/history', [SiswaController::class, 'history'])
    ->name('siswa.history');

Route::get('siswa/cetak-semua', [SiswaController::class, 'cetakSemua'])
    ->name('siswa.cetak.semua');

Route::post('siswa/import', [SiswaController::class, 'import'])
    ->name('siswa.import');

Route::post('siswa/{id}/restore', [SiswaController::class, 'restore'])
    ->name('siswa.restore');

Route::delete('siswa/{id}/force-delete', [SiswaController::class, 'forceDelete'])
    ->name('siswa.forceDelete');

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

// Route Khusus Walikelas 
Route::get('walikelas/history', [WalikelasController::class, 'history'])->name('walikelas.history');
Route::post('walikelas/{id}/restore', [WalikelasController::class, 'restore'])->name('walikelas.restore');
Route::delete('walikelas/{id}/force-delete', [WalikelasController::class, 'forceDelete'])->name('walikelas.forceDelete');

// Route Utility (Import & Export)
Route::post('walikelas/import', [WalikelasController::class, 'import'])->name('walikelas.import');
Route::get('walikelas/cetak-semua', [WalikelasController::class, 'cetakSemua'])->name('walikelas.cetak.semua');

Route::resource('walikelas', WalikelasController::class);
    // Pelanggaran
Route::get('pelanggaran/history', [PelanggaranController::class, 'history'])->name('pelanggaran.history');
Route::get('pelanggaran/cetak-semua', [PelanggaranController::class, 'cetakSemua'])->name('pelanggaran.cetak-semua');
Route::post('pelanggaran/import', [PelanggaranController::class, 'import'])->name('pelanggaran.import');

Route::post('pelanggaran/{id}/restore', [PelanggaranController::class, 'restore'])->name('pelanggaran.restore');
Route::delete('pelanggaran/{id}/force-delete', [PelanggaranController::class, 'forceDelete'])->name('pelanggaran.forceDelete');

Route::resource('pelanggaran', PelanggaranController::class);
    });

    Route::prefix('monitoring')->group(function () {

        Route::get('/log', [LogAktivitasController::class, 'indexLog'])->name('log');
        
    });

    Route::post('/logout-admin', function (Request $request) { Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login');
    })->name('logout.admin');

});

/*
|--------------------------------------------------------------------------
| GURU BK ROUTES
|--------------------------------------------------------------------------
*/
    Route::prefix('gurubk')->name('gurubk.')->group(function () {
        Route::get('/login', [GuruAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [GuruAuthController::class, 'login'])->name('login.submit');
    });

Route::middleware(['auth', 'role:GuruBK'])->prefix('gurubk')->name('gurubk.')->group(function () {

    // Route Laporan Bulanan 
    Route::get('/laporan', [LaporanBulananController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/create', [LaporanBulananController::class, 'create'])->name('laporan.create');
    Route::post('/laporan/store', [LaporanBulananController::class, 'guruStore'])->name('laporan.store');
    Route::get('/laporan/cetak/{id}', [LaporanBulananController::class, 'cetakPdf'])->name('gurubk.laporan.cetak');

    // Dashboard & Chat
    Route::get('/dashboard', [DashboardbkController::class, 'dashboard'])->name('dashboard');
    Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('chat/{id}/reply', [ChatController::class, 'reply'])->name('chat.reply');
    Route::post('chat/{id}/read', [ChatController::class, 'markRead'])->name('chat.read');

    // Konseling
    Route::get('/conseling-request', [KonselingController::class, 'index'])->name('konseling.index');
    Route::post('/counseling-requests/{id}/approve', [KonselingController::class, 'approve'])->name('counseling.approve');
    Route::get('/jadwal-konseling', [KonselingController::class, 'listKonseling'])->name('konseling.konseling');
    Route::patch('/konseling/{id}/status', [KonselingController::class, 'updateStatus'])->name('konseling.updateStatus');

    // Riwayat Pelanggaran
    Route::get('/riwayatpelanggaran', [RiwayatPelanggaranController::class, 'index'])->name('riwayatpelanggaran.index');
    Route::get('/riwayatpelanggaran/create', [RiwayatPelanggaranController::class, 'create'])->name('riwayatpelanggaran.create');
    Route::post('/riwayatpelanggaran/store', [RiwayatPelanggaranController::class, 'store'])->name('riwayatpelanggaran.store');
    Route::get('/get-kelas-filter', [RiwayatPelanggaranController::class, 'getKelasByJurusan'])->name('get.kelas.filter');
    Route::get('/get-siswa-filter/{id_kelas}', [RiwayatPelanggaranController::class, 'getSiswaByKelas'])->name('get.siswa.filter');
    Route::resource('riwayatpelanggaran', RiwayatPelanggaranController::class);

    // Akumulasi poin pelanggaran 
    Route::get('/akumulasi-pelanggaran', [RiwayatPelanggaranController::class, 'akumulasi'])->name('riwayatpelanggaran.akumulasi');

    // Saran
    Route::get('/saran', [SaranController::class, 'index'])->name('saran.index');
    Route::patch('/saran/{id}/read', [SaranController::class, 'markAsRead'])->name('saran.read');
    Route::get('/saran/export', [SaranController::class, 'exportPdf'])->name('saran.export');

    // Self Report
    Route::prefix('selfreport')->name('selfreport.')->group(function () {
        Route::get('/', [SelfReportController::class, 'index'])->name('index');
        Route::get('/arsip', [SelfReportController::class, 'arsip'])->name('arsip');
        Route::get('/{id}', [SelfReportController::class, 'detail'])->name('show');
        Route::post('/verifikasi/{id}', [SelfReportController::class, 'verifikasi'])->name('verifikasi');
    });

    // Data Siswa
    Route::get('/siswa/cetak/semua', [GuruBkSiswaController::class, 'cetakSemua'])->name('siswa.cetak.semua');
    Route::get('/siswa', [GuruBkSiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/{id}', [GuruBkSiswaController::class, 'show'])->name('siswa.show');

    // E-Surat
    Route::prefix('e_surat')->group(function () {
    Route::get('/stream/{filename}', [E_SuratController::class, 'stream_pdf'])->name('e_surat.stream');
    Route::post('/{id}/email', [E_SuratController::class, 'send_email'])->name('e_surat.send_email');
    Route::get('/{id}/print-pdf', [E_SuratController::class, 'print_pdf'])->name('e_surat.print_pdf');
    Route::get('/{id}/export', [E_SuratController::class, 'export'])->name('e_surat.export');
    Route::get('/{id}/selesai', [E_SuratController::class, 'selesai'])->name('e_surat.selesai');
});

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

        Route::get('/mailbox', [KotakSuratController::class, 'index'])->name('kotaksurat.index');
        Route::get('/mailbox/{id}', [KotakSuratController::class, 'show'])->name('kotaksurat.show');
        Route::post('/mailbox/{id}/read', [KotakSuratController::class, 'markAsRead']);

        Route::get('/ajukan-konseling', [KonselingSiswaController::class, 'create'])->name('konseling.create');
        Route::post('/ajukan-konseling', [KonselingSiswaController::class, 'store'])->name('konseling.store');
        Route::post('/mailbox/{id}/read', [KonselingSiswaController::class, 'markAsRead'])->name('mailbox.read');

        Route::get('/home', [DashboardSiswaController::class, 'dashboard'])->name('home');
        Route::get('/history', [DashboardSiswaController::class, 'history'])->name('history');
        Route::get('/profile', [DashboardSiswaController::class, 'profile'])->name('profile');

        Route::get('/chat/{id}', [KonselingSiswaController::class, 'chatRoom'])->name('chat');
        Route::post('/chat/send', [KonselingSiswaController::class, 'storeChat'])->name('chat.send');

        Route::get('/kirim-saran', [SaranSiswaController::class, 'show'])->name('kirim-saran');
        Route:: post('/kirim-saran/submit', [SaranSiswaController::class, 'store'])->name('saran.store');

        Route::get('/selfreport', [SelfReportSiswaController::class, 'show'])->name('selfreport');        
        Route::post('/selfreport/check', [SelfReportSiswaController::class, 'checkStatus'])->name('selfreport.check');
        Route::post('/selfreport/store', [SelfReportSiswaController::class, 'store'])->name('selfreport.store');
        Route::get('/selfreport/store', function() { return redirect()->route('siswa.selfreport');});

        Route::post('/update-foto', [DashboardSiswaController::class, 'updateFoto'])->name('update_foto');
        
    });
});

// logout all role
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

