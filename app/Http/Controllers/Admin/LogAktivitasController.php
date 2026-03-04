<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogAktivitasController extends Controller
{
public function indexLog()
{
    $user = Auth::user();
    
    // Ambil data mentah tanpa JOIN dulu agar data PASTI muncul
    $logs = DB::table('log_aktivitas')
              ->orderBy('waktu_akses', 'desc')
              ->paginate(15);

    // Deteksi role secara sederhana untuk title
    $role = ($user && ($user->role == 'guru' || $user->role == 'admin')) ? 'guru' : 'siswa';
    $title = ($role == 'guru') ? 'Monitoring Log Aktivitas' : 'Riwayat Aktivitas';

    // Pastikan path view sesuai folder yang kamu sebutkan (admin/monitoring/log_aktivitas)
    return view('admin.log_aktivitas.index', compact('logs', 'role', 'title'));
}
}