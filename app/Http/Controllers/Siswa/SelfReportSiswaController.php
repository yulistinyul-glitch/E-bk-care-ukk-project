<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SelfReport;
use Illuminate\Support\Str; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class SelfReportSiswaController extends Controller
{
    public function show() {
        return view('siswa.selfreport.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_masalah' => 'required',
            'isi_laporan' => 'required',
        ]);

        $newID = 'SR-' . strtoupper(Str::random(5));

        $pathBukti = null;
        if ($request->hasFile('bukti')) {
            $pathBukti = $request->file('bukti')->store('evidence', 'public');
        }

        SelfReport::create([
                'id_report'        => $newID,
                'tanggal_lapor'    => now(),
                'kategori_masalah' => $request->kategori_masalah,
                'isi_laporan'      => "LOKASI: {$request->lokasi}\n" . 
                                    "WAKTU: {$request->waktu_kejadian}\n" . 
                                    "PELAKU: {$request->pelaku}\n\n" . 
                                    "KRONOLOGI: {$request->isi_laporan}",
                'file'             => $pathBukti, 
                'status_verifikasi'=> 'menunggu',
                'bukti_pendukung'  => 'foto',
        ]);

        $submittedReports = session()->get('my_reports', []);
        $submittedReports[] = $newID;
        session()->put('my_reports', $submittedReports);

        return redirect()->route('siswa.home')->with('success_report', "Laporan berhasil dikirim! ID Anda: $newID");
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'id_report' => 'required|string' 
        ]);

        $report = SelfReport::where('id_report', strtoupper($request->id_report))->first();

        if ($report) {
            $myReports = session()->get('my_reports', []);
            
            if (!in_array($report->id_report, $myReports)) {
                $myReports[] = $report->id_report;
                session()->put('my_reports', $myReports);
            }

            return redirect()->route('siswa.home')->with('success', 'Laporan ditemukan!');
        }

        return redirect()->back()->with('error', 'Maaf, ID Laporan tidak ditemukan.');
    }
}