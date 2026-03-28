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
    $user = Auth::user();
    // Ambil data siswa (SIS007) berdasarkan user (PS007)
    $siswa = \App\Models\Siswa::where('id_pengguna', $user->id_pengguna)->first();

    if (!$siswa) {
        return redirect()->back()->with('error', 'Profil siswa tidak ditemukan.');
    }

    $id_siswa = $siswa->id_siswa;

    // 1. Ambil Riwayat Konseling
    $riwayatJadwal = \App\Models\CounselingRequest::where('id_siswa', $id_siswa)
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function($item) {
            return [
                'title'  => "Konseling " . $item->kategori,
                'date'   => $item->created_at->translatedFormat('d M Y'),
                'time'   => $item->created_at->format('H:i'),
                'status' => $item->status, // pending, disetujui, dll
            ];
        });

    // 2. Ambil Riwayat Self Report
    // Menggunakan kolom id_siswa yang baru kita tambahkan
    $riwayatReport = \App\Models\SelfReport::where('id_siswa', $id_siswa) 
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function($item) {
            return [
                'title'  => "Self Report: " . $item->kategori_masalah,
                'date'   => $item->created_at->translatedFormat('d M Y'),
                'time'   => null,
                'status' => $item->status_verifikasi, // Sesuaikan dengan ENUM di screenshot kamu
            ];
        });

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