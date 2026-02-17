<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Models\SelfReport;
use Illuminate\Http\Request;

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
        $report = SelfReport::findOrFail($id);

        $active = 'detail'; 

        return view('gurubk.selfreport.detail', compact('report', 'active'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);

        $report = SelfReport::findOrFail($id);
        $report->status_verifikasi = $request->status;
        $report->save();

        return redirect()->route('gurubk.selfreport.arsip')
            ->with('success', 'Status laporan berhasil diperbarui.');
    }
}
