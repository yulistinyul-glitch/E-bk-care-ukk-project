<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Siswa;
use App\Models\GuruBK;
use App\Models\Kelas;
use App\Models\LogAktivitas;

class DashboardAdminController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = Siswa::count();
        $totalGuruBK = GuruBK::count();
        $totalWalas = Kelas::count();

        // Log aktivitas terakhir (tetap ada)
        $logs = LogAktivitas::orderBy('waktu_akses', 'desc')->limit(5)->get();

        // Ambil 5 autentikasi terbaru (login/logout)
        $threshold = time() - 300;

        $users = User::with(['siswa', 'gurubk'])
            ->whereIn('role', ['GuruBK', 'Siswa'])
            ->get();

        $activeSessions = DB::table('sessions')
            ->pluck('user_id')
            ->toArray();

        $latestAuth = $users->map(function ($user) use ($activeSessions, $threshold) {

            $userId = (string)$user->id_pengguna;
            $lastActivity = $user->last_activity;

            if (in_array($userId, $activeSessions)) {
                $status = 'Sedang Login';
            } elseif ($lastActivity) {
                $status = 'Telah Logout';
            } else {
                $status = 'Belum Login';
            }

            return (object)[
                'nama_tampil' => $user->siswa->nama_siswa 
                                ?? ($user->gurubk->nama_guru 
                                ?? $user->username),
                'id_tampil' => $user->siswa->id_siswa 
                                ?? ($user->gurubk->id_gurubk 
                                ?? $user->id_pengguna),
                'role' => $user->role,
                'status' => $status,
                'last_activity' => ($lastActivity && $lastActivity > 1) 
                                    ? $lastActivity 
                                    : null,
            ];
        })
        ->sortByDesc('last_activity')
        ->take(5);

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalGuruBK',
            'totalWalas',
            'logs',        // tetap ada
            'latestAuth'   // tambah autentikasi
        ));
    }
}