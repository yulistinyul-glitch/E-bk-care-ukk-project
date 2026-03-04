<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\GuruBK; 
use App\Models\Kelas;  
use App\Models\LogAktivitas; // <--- Ganti jadi LogAktivitas
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function dashboard()
    {
        // Statistik
        $totalSiswa = Siswa::count();
        $totalGuruBK = GuruBK::count();
        $totalWalas = Kelas::count();

        // Ambil data dari model LogAktivitas
        // Gunakan limit(5) agar tidak berat saat loading dashboard
        $logs = LogAktivitas::orderBy('waktu_akses', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalSiswa', 
            'totalGuruBK', 
            'totalWalas', 
            'logs' 
        ));
    }
}