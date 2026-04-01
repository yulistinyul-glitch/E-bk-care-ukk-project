<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf; // Pastikan sudah install dompdf
use App\Models\LaporanBulanan;
use App\Models\Siswa;
use App\Models\RiwayatPelanggaran;
use App\Models\Konseling;
use App\Models\Saran;
use App\Models\SelfReport; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanBulananController extends Controller
{
    public function index()
    {
        $laporan = LaporanBulanan::where('guru_bk_id', Auth::user()->id_pengguna)
            ->orderBy('bulan', 'desc')
            ->get();
        return view('gurubk.laporan.index', compact('laporan'));
    }

    public function create()
    {
        return view('gurubk.laporan.create');
    }

public function guruStore(Request $request)
{
    $request->validate(['bulan' => 'required']);

    $bulan = $request->bulan; 
    $year = substr($bulan, 0, 4);
    $month = substr($bulan, 5, 2);
    $id_guru = Auth::user()->id_pengguna;

    // 1. Ambil semua ID Siswa
    $siswaIds = \App\Models\Siswa::pluck('id_siswa');

    // 2. Hitung BERAPA SISWA yang melanggar (Bukan poinnya)
    // Kita gunakan distinct('id_siswa') supaya kalau SIS007 melanggar 2x, tetap dihitung 1 orang
    $total_pelanggaran = \App\Models\RiwayatPelanggaran::whereIn('id_siswa', $siswaIds)
        ->whereYear('tanggal_kejadian', $year)
        ->whereMonth('tanggal_kejadian', $month)
        ->distinct('id_siswa')
        ->count('id_siswa'); 

    // 3. Self Report (Anonim - Berdasarkan id_report)
    $total_selfreport = \App\Models\SelfReport::whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->count(); 

    // 4. Saran & Konseling (Berdasarkan jumlah data/kejadian)
    $total_saran = \App\Models\Saran::whereIn('id_siswa', $siswaIds)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->count();

    $total_konseling = \App\Models\Konseling::whereIn('id_siswa', $siswaIds)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->count();

    // 5. Simpan/Update
    \App\Models\LaporanBulanan::updateOrCreate(
        ['guru_bk_id' => $id_guru, 'bulan' => $bulan],
        [
            'total_pelanggaran' => $total_pelanggaran,
            'total_saran'       => $total_saran,
            'total_selfreport'  => $total_selfreport,
            'total_konseling'   => $total_konseling,
            'status'            => 'terkirim',
        ]
    );

    return redirect()->route('gurubk.laporan.index')->with('success', 'Laporan Berhasil Disimpan!');
}
public function cetakPdf($id)
{
    $laporan = LaporanBulanan::findOrFail($id);
    
    $year = substr($laporan->bulan, 0, 4);
    $month = substr($laporan->bulan, 5, 2);

    // Ambil data detail seperti biasa
    $detail_pelanggaran = RiwayatPelanggaran::with(['siswa.kelas', 'pelanggaran'])
        ->whereYear('tanggal_kejadian', $year)
        ->whereMonth('tanggal_kejadian', $month)
        ->get();

    $detail_saran = Saran::with('siswa')
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->get();

    $detail_selfreport = SelfReport::whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->get();

    $detail_konseling = Konseling::with('siswa')
        ->whereYear('tanggal_konseling', $year)
        ->whereMonth('tanggal_konseling', $month)
        ->get();

    // --- BAGIAN PENAMAAN FILE DINAMIS ---
    // Carbon akan otomatis menerjemahkan bulan ke bahasa Indonesia jika locale Laravel sudah 'id'
    $namaBulan = \Carbon\Carbon::parse($laporan->bulan)->translatedFormat('F Y');
    $namaFile = "Laporan Bulanan Sistem E-BK Care - " . $namaBulan . ".pdf";

    $pdf = Pdf::loadView('gurubk.laporan.pdf', compact(
        'laporan', 
        'detail_pelanggaran', 
        'detail_saran', 
        'detail_selfreport', 
        'detail_konseling'
    ));
    
    // Gunakan STREAM agar muncul preview di browser dengan nama file yang sesuai saat di-save
    return $pdf->setPaper('a4', 'portrait')->stream($namaFile);
}
}