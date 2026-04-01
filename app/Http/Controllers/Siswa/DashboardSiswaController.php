<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\KotakSurats;
use App\Models\Siswa;
use App\Models\CounselingSession;
use App\Models\SelfReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class DashboardSiswaController extends Controller
{
    public function dashboard()
    {
        $id_siswa = Auth::user()->siswa;
        if (!$id_siswa) {
          return redirect()->back()->with('error', 'Profil siswa tidak ditemukan.');
        }
        $newMail = KotakSurats::where('id_siswa', $id_siswa->id_siswa)
                                ->where('is_read', false)
                                ->first();
        $id_siswa_string = $id_siswa->id_siswa;
        $lastChat = Chat::whereHas('konseling', function($query) use ($id_siswa_string) {
                        $query->where('id_siswa', $id_siswa_string);
                    })
                    ->latest()
                    ->first();

        $unreadMessages = KotakSurats::where('id_siswa', $id_siswa->id_siswa)->whereNull('read_at')->count();

        $scheduled = CounselingSession::whereHas('request', function($q) use ($id_siswa_string) {
            $q->where('id_siswa', $id_siswa_string); })
            ->where('status', 'dijadwalkan') 
            ->whereDate('scheduled_date', '>=', now()->toDateString())
            ->orderBy('scheduled_time', 'asc')
            ->first();

        $sessionIds = session()->get('my_sessions', []);
        $reports = SelfReport::whereIn('id_report', $sessionIds)
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        $totalPoint = $id_siswa->riwayatPelanggaran->sum('poin');
        if ($totalPoint <= 20 ) {
            $status = ['warna' => 'bg-green-500', 'teks' => 'Aman', 'label' => 'text-green-600', 'icon' => 'bi-circle'];
        } elseif ($totalPoint <= 50) {
            $status = ['warna' => 'bg-yellow-400', 'teks' => 'Peringatan', 'label' => 'text-yellow-600', 'icon' => 'bi-exclamation-triangle'];
        } elseif ($totalPoint <= 75) {
            $status = ['warna' => 'bg-orange-500', 'teks' => 'Waspada (SP 1/2)', 'label' => 'text-orange-600', 'icon' => 'bi-exclamation-octagon'];
        } else {
            $status = ['warna' => 'bg-red-600', 'teks' => 'Bahaya (SP 3)', 'label' => 'text-red-600', 'icon' => 'bi-x-octagon-fill'];
    }
        return view('siswa.home', compact('lastChat', 'unreadMessages', 'scheduled', 'reports', 'status', 'newMail'));
    }

    public function history()
{
    $user = Auth::user();
    $siswa = \App\Models\Siswa::where('id_pengguna', $user->id_pengguna)->first();

    if (!$siswa) {
        return redirect()->back()->with('error', 'Profil siswa tidak ditemukan.');
    }

    $id_siswa = $siswa->id_siswa;

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

  
    $riwayatReport = \App\Models\SelfReport::where('id_siswa', $id_siswa) 
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function($item) {
            return [
                'title'  => "Self Report: " . $item->kategori_masalah,
                'date'   => $item->created_at->translatedFormat('d M Y'),
                'time'   => null,
                'status' => $item->status_verifikasi, 
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