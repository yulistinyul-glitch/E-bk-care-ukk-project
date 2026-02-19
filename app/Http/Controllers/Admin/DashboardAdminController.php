<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// Import model Anda di sini
use App\Models\Siswa;
use App\Models\GuruBK;
use App\Models\Kelas; 

class DashboardAdminController extends Controller
{
    public function dashboard()
    {
        // Mengambil total data dari database secara real-time
        $totalSiswa = Siswa::count();
        $totalGuruBK = GuruBK::count();
        
        // Biasanya wali kelas dihitung dari jumlah kelas yang ada
        $totalWalas = Kelas::count(); 

        // Mengirim data ke file admin/dashboard.blade.php
        return view('admin.dashboard', compact('totalSiswa', 'totalGuruBK', 'totalWalas'));
    }
}