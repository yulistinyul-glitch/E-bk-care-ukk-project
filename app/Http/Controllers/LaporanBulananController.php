<?php

namespace App\Http\Controllers;

use App\Models\LaporanBulanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Saran;
use App\Models\SelfReport;
use App\Models\Konseling;
use App\Models\Siswa;
use App\Models\RiwayatPelanggaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class LaporanBulananController extends Controller
{

public function create()
{
    return view('gurubk.laporan.create');
}
    // ======================
    // GURU BK
    // ======================
    public function guruIndex()
    {
        $laporan = LaporanBulanan::where('guru_bk_id', Auth::user()->id_gurubk)
            ->orderBy('bulan', 'desc')
            ->get();

        return view('gurubk.laporan.index', compact('laporan'));
    }

public function guruStore(Request $request)
{
    $request->validate([
        'bulan' => 'required',
    ]);

    $bulan = $request->bulan;
    $year = substr($bulan, 0, 4);
    $month = substr($bulan, 5, 2);

    // ambil siswa berdasarkan guru BK
    $siswaIds = Siswa::where('guru_bk_id', Auth::user()->id_gurubk)
        ->pluck('id_siswa');

    if ($siswaIds->isEmpty()) {
        return back()->with('error', 'Siswa belum ada!');
    }

    // 🔥 FIX SEMUA QUERY
    $total_pelanggaran = RiwayatPelanggaran::whereIn('id_siswa', $siswaIds)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->count();

    $total_saran = Saran::whereIn('id_siswa', $siswaIds)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->count();

    $total_selfreport = SelfReport::whereIn('id_siswa', $siswaIds)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->count();

    $total_konseling = Konseling::whereIn('id_siswa', $siswaIds)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->count();

    LaporanBulanan::create([
        'guru_bk_id' => Auth::user()->id_gurubk,
        'bulan' => $bulan,
        'total_pelanggaran' => $total_pelanggaran,
        'total_saran' => $total_saran,
        'total_selfreport' => $total_selfreport,
        'total_konseling' => $total_konseling,
        'status' => 'terkirim',
    ]);

    return redirect()->route('gurubk.laporan.index')
        ->with('success', 'Laporan berhasil dibuat!');
}

    // ======================
    // ADMIN
    // ======================
    public function adminIndex()
    {
        $laporan = LaporanBulanan::with('guruBK')->latest()->get();
        return view('admin.laporan.index', compact('laporan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $laporan = LaporanBulanan::findOrFail($id);

        $laporan->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status diupdate');
    }

public function exportPDF($id)
{
    $laporan = LaporanBulanan::with('guruBK')->findOrFail($id);

    $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporan'));

    return $pdf->download('laporan-'.$laporan->bulan.'.pdf');
}

}