<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SelfReport;
use App\Models\Siswa;
use Illuminate\Support\Str; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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
            'bukti' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi,mp3,wav',
        ]);

        $newID = 'SR-' . strtoupper(Str::random(5));

        $pathBukti = null;
        if ($request->hasFile('bukti')) {
            $pathBukti = $request->file('bukti')->store('evidence', 'public');
        }

        $user = Auth::user();
        $siswa = Siswa::where('id_pengguna', $user->id_pengguna)->first();
     

        if (!$siswa) {
            return redirect()->back()->with('error', 'Profil siswa tidak ditemukan untuk Id: ' . $user->id_pengguna);
        }

        SelfReport::create([
                'id_report'        => $newID,
                'id_siswa'         => $siswa->id_siswa,
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