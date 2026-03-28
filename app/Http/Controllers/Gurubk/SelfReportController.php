<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Models\SelfReport;
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
    // 1. Validasi input
    $request->validate([
        'kategori_masalah' => 'required',
        'isi_laporan' => 'required',
        // ... validasi lainnya
    ]);

    // 2. Ambil data siswa yang sedang login
    $user = Auth::user();
    $siswa = \App\Models\Siswa::where('id_pengguna', $user->id_pengguna)->first();

    // 3. Simpan laporan dengan menyertakan id_siswa
    \App\Models\SelfReport::create([
        'id_report' => 'REP' . rand(100, 999), // Contoh generate ID manual jika perlu
        'id_siswa' => $siswa->id_siswa,       // <--- INI YANG PENTING
        'tanggal_lapor' => now(),
        'kategori_masalah' => $request->kategori_masalah,
        'isi_laporan' => $request->isi_laporan,
        'status_verifikasi' => 'menunggu',
        // ... field lainnya
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
        $report->status_verifikasi = $request->status;
        
        $report->id_gurubk = Auth::user()->id_gurubk; 
        $report->save();

        return redirect()->route('gurubk.selfreport.arsip')
            ->with('success', 'Status laporan berhasil diperbarui.');
    }
}
