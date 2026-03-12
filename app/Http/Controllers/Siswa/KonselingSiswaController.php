<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CounselingRequest;
use App\Models\CounselingSession;
use App\Models\KotakSurats;
use App\Models\Chat;
use App\Events\BotResponded;
use App\Models\Siswa;
use App\Models\SelfReport;
use Illuminate\Support\Facades\Auth;

class KonselingSiswaController extends Controller
{

    private function getIdSiswa() {
        $siswa = Siswa::where('id_pengguna', Auth::user()->id_pengguna)->first();
        return $siswa ? $siswa->id_siswa : null;
    }

    public function index()
    {
        $id_siswa = $this-> getIdSiswa();
        $surat = KotakSurats::where('id_siswa', Auth::user()->id_siswa)
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('siswa.kotaksurat.index', compact('surat'));
    }

    public function create()
    {
        return view('siswa.konseling.create');
    }

   public function store(Request $request)
    {

        $request->validate([
            'kategori' => 'required',
            'pilihan_metode' => 'required',
            'deskripsi' => 'required|min:10',
        ]);

        $id_siswa = $this->getIdSiswa();

        CounselingRequest::create([
            'id_siswa' => $id_siswa, 
            'kategori' => $request->kategori,
            'pilihan_metode' => $request->pilihan_metode,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending',
        ]);

        return redirect()->route('siswa.home')->with('success', 'Berhasil Dikirim');
    }

    public function markAsRead($id)
    {
        $id_siswa = $this->getIdSiswa(); 
        $surat = KotakSurats::where('id', $id)
                            ->where('id_siswa', $id_siswa)
                            ->firstOrFail();
        
        $surat->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function home()
    {
    $user = Auth::user();
    $siswa = Siswa::where('id_pengguna', $user->id_pengguna)->first();

    if (!$siswa) { 
        abort(404, 'Data Siswa Tidak Ditemukan'); 
    }

    $id_siswa = $siswa->id_siswa;

    $unreadMessages = \App\Models\KotakSurats::where('id_siswa', $id_siswa)
                    ->where('is_read', false)
                    ->count();

    $lastChat = Chat::whereHas('konseling', function($query) use ($id_siswa) {
                    $query->where('id_siswa', $id_siswa);
                })->latest()->first();

    $jadwalTerdekat = CounselingSession::whereHas('request', function($query) use ($id_siswa) {
        $query->where('id_siswa', $id_siswa);
    })
    ->where('status', 'dijadwalkan') 
    ->where('scheduled_date', '>=', now())
    ->orderBy('scheduled_date', 'asc')
    ->orderBy('scheduled_time', 'asc')
    ->first();

    $sessionIds = session()->get('my_reports', []);
    $reports = \App\Models\SelfReport::whereIn('id_report', $sessionIds)
                ->orderBy('created_at', 'desc')
                ->get();
    
    return view('siswa.home', compact('lastChat', 'jadwalTerdekat', 'unreadMessages', 'reports'));
    }

    public function storeChat(Request $request)
    {
        $request->validate([
            'message' => 'required_if:file,null',
            'file' => 'nullable|image|max:2048'
        ]);

        $id_siswa = $this->getIdSiswa();
        $konseling = CounselingRequest::where('id_siswa', $id_siswa)
                    ->whereIn('status', ['accepted', 'ongoing'])
                    ->latest()
                    ->first();
        if (!$konseling) {
            return response()->json(['status' => 'error', 'message' => 'Sesi Chat tidak aktif']);
        }

       $chat = Chat::create([
            'konseling_id' => $konseling->id,
            'sender_type' => 'siswa',
            'message' => $request->message ?? '',
            'is_read' => 0
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('chats', 'public');
            $chat->update(['file_path' => $path]);
        }

        broadcast(new BotResponded($chat))->toOthers();

        return response()->json([
            'status' => 'success',
            'message' => $chat->message,
            'file_url' => $chat->file_path ? asset('storage/' . $chat->file_path) : null,
            'time' => $chat->created_at->format('H:i A')
        ]);
    }

   public function chatRoom($id)
    {
        $siswa = Siswa::where('id_pengguna', Auth::user()->id_pengguna)->first();

        if (!$siswa) {
        abort(404, 'Siswa tidak ditemukan');
        }

       $chats = Chat::where('konseling_id', $id)
                ->orderBy('created_at', 'asc')
                ->get();

        Chat::where('konseling_id', $id)
            ->where('sender_type', '!=', 'siswa')
            ->update(['is_read' => 1]);

        return view('siswa.room-chat', compact('chats', 'id'));
    }

}