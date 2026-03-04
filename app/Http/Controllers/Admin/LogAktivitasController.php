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
        
        // Gunakan query builder yang bersih
        $query = DB::table('log_aktivitas')->orderBy('waktu_akses', 'desc');

        if ($user && ($user->role == 'guru' || $user->role == 'admin')) {
            // GURU: Pakai leftJoin agar data log tetap muncul meskipun usernya (amit-amit) terhapus
            $logs = $query->leftJoin('users', 'log_aktivitas.id_pengguna', '=', 'users.id')
                          ->select('log_aktivitas.*', 'users.name as nama_user')
                          ->paginate(15);
            $role = 'guru';
            $title = 'Monitoring Log Aktivitas';
        } else {
            // SISWA: Hanya ambil miliknya sendiri
            $userId = $user ? $user->id : 0;
            $logs = $query->where('id_pengguna', $userId)
                          ->paginate(15);
            $role = 'siswa';
            $title = 'Riwayat Aktivitas';
        }

        return view('admin.log_aktivitas.index', compact('logs', 'role', 'title'));
    }
}