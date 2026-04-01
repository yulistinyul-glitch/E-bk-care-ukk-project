<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Models\SelfReport;
use App\Models\Gurubk;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SelfReportController extends Controller
{
    public function index()
    {
        $reports = SelfReport::where('status_verifikasi', 'menunggu')
                    ->orderBy('tanggal_lapor', 'desc')
                    ->get();

        $active = 'index'; 
        return view('gurubk.selfreport.index', compact('reports', 'active'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_masalah' => 'required|in:bullying,ancaman,kekerasan,konflik,pencurian,lainnya',
            'isi_laporan'      => 'required|min:10',
            'bukti_pendukung'  => 'nullable|in:foto,vidio,audio',
            'lokasi'           => 'required|string',
            'waktu_kejadian'   => 'required|string',
            ]);


        $user = Auth::user();
        $siswa = Siswa::where('id_pengguna', $user->id_pengguna)->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Profil siswa tidak ditemukan.');
        }

        $id_siswa = $siswa->id_siswa;

        $reportComplete = "LOKASI:" .($request->lokasi ?? '-') . "\n";
        $reportComplete .= "WAKTU KEJADIAN:" .($request->waktu_kejadian ?? '-') . "\n";
        $reportComplete .= "PELAKU:" . ($request->pelaku ?? '-') . "\n";
        $reportComplete .= "--- ISI LAPORAN ---\n";
        $reportComplete .= $request->isi_laporan . "\n";

        SelfReport::create([
            'id_report' => 'REP' . rand(100, 999),
            'id_siswa' => $id_siswa,
            'tanggal_lapor' => now(),
            'kategori_masalah' => $request->kategori_masalah,
            'isi_laporan' => $reportComplete,
            'bukti_pendukung' => $request->bukti_pendukung,
            'status_verifikasi' => 'menunggu',
        ]);

    return redirect()->route('siswa.selfreport.index')->with('success', 'Laporan berhasil dikirim');
}

    public function arsip()
    {
        $reports = SelfReport::whereIn('status_verifikasi', ['disetujui', 'ditolak'])
                    ->orderBy('tanggal_lapor', 'desc')
                    ->get();

        $active = 'arsip'; 
        return view('gurubk.selfreport.arsip', compact('reports', 'active'));
    }

    public function detail($id)
    {
        $report = SelfReport::where('id_report', $id)->firstOrFail();
        $active = 'detail'; 

        return view('gurubk.selfreport.detail', compact('report', 'active'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);

        $report = SelfReport::where('id_report', $id)->firstOrFail();
        $user = Auth::user();
        
        $guru = \App\Models\Gurubk::where('id_pengguna', $user->id_pengguna)->first();

        if (!$guru) {
            return redirect()->back()->with('error', "User {$user->id_pengguna} tidak terdaftar di tabel Guru BK. Silahkan hubungi Admin.");
        }

        $report->update([
            'status_verifikasi' => $request->status,
            'id_gurubk'         => $guru->id_gurubk
        ]);

        return redirect()->route('gurubk.selfreport.index')
            ->with('success', 'Laporan #' . $id . ' berhasil di' . $request->status . '.');
    }
}
