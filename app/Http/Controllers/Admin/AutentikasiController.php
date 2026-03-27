<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AutentikasiController extends Controller
{
    public function index()
    {
        $threshold = time() - 300;

        $users = User::with(['siswa', 'gurubk'])
            ->whereIn('role', ['GuruBK', 'Siswa'])
            ->get();

        // Ambil user yg sedang login dari sessions
        $activeSessions = DB::table('sessions')
            ->pluck('user_id')
            ->toArray();

        $data = $users->map(function ($user) use ($activeSessions, $threshold) {

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
        });

        return view('admin.autentikasi', compact('data'));
    }
}