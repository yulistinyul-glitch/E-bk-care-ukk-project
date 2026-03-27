<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\KotakSurats;
use App\Models\Siswa;
use App\Models\CounselingSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function history()
    {
        $id_siswa = Auth::user()->id_siswa;

        $allHistory = \App\Models\KotakSurats::where('id_siswa', $id_siswa)
            ->orderBy('created_at', 'desc')
            ->get();

        $riwayatJadwal = $allHistory->filter(function($item) {
            return str_contains(strtolower($item->judul_surat), 'undangan') || 
                str_contains(strtolower($item->judul_surat), 'jadwal');
        })->map(function($item) {
            return [
                'title' => $item->judul_surat,
                'date'  => $item->created_at->translatedFormat('d M Y'),
                'time'  => $item->created_at->format('H:i'),
                'status'=> $item->status ?? 'selesai' // Sesuaikan dengan kolom status di db mu
            ];
        })->values();

        $riwayatReport = $allHistory->filter(function($item) {
            return !str_contains(strtolower($item->judul_surat), 'undangan');
        })->map(function($item) {
            return [
                'title' => $item->judul_surat,
                'date'  => $item->created_at->translatedFormat('d M Y'),
                'time'  => null,
                'status'=> 'selesai'
            ];
        })->values();

    return view('siswa.history', compact('riwayatJadwal', 'riwayatReport'));
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

    public function profile()
    {
        $id_siswa = Auth::user()->id_siswa;
        return view('siswa.profile');
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $siswa = $user->siswa;

        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            $fileName = 'foto_' . $siswa->id_siswa . '_' . time() . '.' . $file->getClientOriginalExtension();

            $targetPath = public_path('storage/profile_siswa');

            if ($siswa->foto && file_exists($targetPath . '/' . $siswa->foto)) {
                unlink($targetPath . '/' . $siswa->foto);
            }

            $file->move($targetPath, $fileName);

            $siswa->update([
                'foto' => $fileName
            ]);

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui! ✨');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah foto.');
    }
}