<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use App\Models\CounselingRequest;
use App\Models\CounselingSession;
use App\Models\KotakSurats; 
use Illuminate\Support\Facades\DB;

class KonselingController extends Controller
{
    public function index()
    {
        $requests = CounselingRequest::where('status', 'pending')->with('siswa')->latest()->get();
        return view('gurubk.konseling.index', compact('requests'));
    }

    public function approve(Request $request, $id)
    {
    $request->validate([
        'scheduled_date' => 'required|date|after_or_equal:today',
        'scheduled_time' => 'required',
        'location_link' => 'required|string',
    ]);

    $count = CounselingSession::where('scheduled_date', $request->scheduled_date)->count();
    if ($count >= 4) {
        return back()->with('error', 'Kuota penuh! maksimal 4 jadwal per hari.');
    }

    DB::transaction(function () use ($request, $id) {
        $counselingRequest = CounselingRequest::with('siswa')->findOrFail($id);
        $counselingRequest->update(['status' => 'accepted']);
        
        $session = CounselingSession::create([
            'request_id' => $id,
            'scheduled_date' => $request->scheduled_date,
            'scheduled_time' => $request->scheduled_time,
            'location_link' => $request->location_link,
            'status' => 'dijadwalkan',
        ]);

        KotakSurats::create([
            'id_siswa' => $counselingRequest->siswa->id_siswa,
            'session_id' => $session->id,
            'subject' => 'Undangan Konseling: ' . $counselingRequest->kategori, 
            'message' => "Halo👋🏻" . $counselingRequest->siswa->nama_siswa . ",\n\n" .
                         "Permintaan konselingmu telah disetujui! \n" . 
                         "Silahkan datang atau join pada: \n" .
                         "Tanggal:" . $request->scheduled_date . "\n" . 
                         "Jam" . $request->scheduled_time . "WIB\n" . 
                         "Tempat/Link:" . $request->location_link,
            'is_read' => false,
            'type' => 'success',
        ]);

        $botMessage = Chat::create([
            'konseling_id' => $id, 
            'sender_type' => 'bot',
            'message' => 'Halo! Permintaan jadwal konseling kamu sudah disetujui. Silakan cek kotak surat untuk detailnya.',
            'is_read' => 0
        ]);

        broadcast(new \App\Events\BotResponded($botMessage))->toOthers();
    });

    return redirect()->back()->with('success', 'Jadwal berhasil dibuat dan surat terkirim!');
    }

    public function listKonseling()
    {
        $sessions = CounselingSession::with(['request.siswa'])
                                    ->where('status', 'dijadwalkan')
                                    ->orderBy('scheduled_date', 'asc')
                                    ->orderBy('scheduled_time', 'asc')
                                    ->get()
                                    ->groupBy(function($item) {
                                        return \Carbon\Carbon::parse($item->scheduled_date)->translatedFormat('l, d F Y');
                                    });
        return view('gurubk.konseling.konseling', compact('sessions'));
    }

public function updateStatus(Request $request, $id)
{
    $session = CounselingSession::with('request')->findOrFail($id);
    $statusBaru = $request->status; 
    $session->update([
        'status' => $statusBaru
    ]);

    if ($session->request) {
        $statusUntukRequest = ($statusBaru == 'selesai') ? 'accepted' : 'rejected';
        $session->request->update([
            'status' => $statusUntukRequest
        ]);
     }

     return redirect()->route('gurubk.konseling.konseling')->with('success', 'Status Berhasil Diperbaharui!');
    }
}