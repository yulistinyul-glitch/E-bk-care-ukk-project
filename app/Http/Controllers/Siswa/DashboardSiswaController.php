<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\KotakSurats;
use App\Models\CounselingSession;
// Perbaikan: Gunakan Facades\Auth
use Illuminate\Support\Facades\Auth; 

class DashboardSiswaController extends Controller
{
    public function dashboard()
    {
        $id_siswa = Auth::user()->id_siswa;

        $lastChat = Chat::whereHas('konseling', function($query) use ($id_siswa) {
                        $query->where('id_siswa', $id_siswa);
                    })
                    ->latest()
                    ->first();

        $unreadMessages = KotakSurats::where('id_siswa', $id_siswa)->whereNull('read_at')->count();
        $jadwalTerdekat = CounselingSession::whereHas('request', function($q) use ($id_siswa) {
            $q->where('id_siswa', $id_siswa);
        })->where('scheduled_date', '>=', now())->first();

        return view('siswa.home', compact('lastChat', 'unreadMessages', 'jadwalTerdekat'));
    }

    public function chat()
    {
        $user = Auth::user();
        $id_siswa = $user->id_siswa;

        $chats = Chat::whereHas('konseling', function($query) use ($id_siswa) {
        $query->where('id_siswa', $id_siswa);
        })
            ->orderBy('created_at', 'asc')
            ->get();

     return view('siswa.room-chat', compact('chats'));
    }
}