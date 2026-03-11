<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saran;
use Barrier;
use Barryvdh\DomPDF\Facade\Pdf;

class SaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Saran::with('siswa');
        if($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
        if ($request->filled('target')) {
            $query->where('target', $request->target);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
       $saran = $query->latest()->get();
        $totalSaran = Saran::count();
        return view('gurubk.saran.index', compact('saran', 'totalSaran'));
    }

    public function markAsRead($id)
    {
        $saran = Saran::findOrFail($id);
        $saran->update(['status' => 'read']);

        return back()->with('success', 'Saran telah ditandai sebagai dibaca');
    }

    public function exportPdf(Request $request)
    {
        $query = Saran::with('siswa');
        if($request->filled('tanggal')) 
            $query->whereDate('created_at', $request->tanggal);
        if ($request->filled('target'))
            $query->where('target', $request->target);
        if($request->filled('status'))
            $query->where('status', $request->status);

        $saran = $query->latest()->get();
        $pdf = Pdf::loadView('gurubk.saran.pdf', compact('saran'));

        return $pdf->download('Laporan_Saran_Siswa_'. date('Y-m-d').'.pdf');
    }
}
