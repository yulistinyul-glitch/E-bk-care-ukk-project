<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CounselingRequest;
use App\Models\CounselingSession;
use App\Models\KotakSurats;
use App\Models\Chat;
use App\Events\BotResponded;
use Illuminate\Support\Facades\Auth;


class KonselingSiswaController extends Controller
{
    public function index()
    {
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
        $id_siswa = Auth::user()->id_siswa ?? Auth::user()->siswa->id_siswa;

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
        $surat = KotakSurats::where('id', $id)
                            ->where('id_siswa', Auth::user()->id_siswa)
                            ->firstOrFail();
        
        $surat->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }

    public function home()
    {
        $id_siswa = Auth::user()->id_siswa;

        $lastChat = Chat::whereHas('konseling', function($query) use ($id_siswa) {
                        $query->where('id_siswa', $id_siswa);
                    })
                    ->latest()
                    ->first();

        $jadwalTerdekat = CounselingSession::whereHas('request', function($query) use ($id_siswa) {
            $query->where('id_siswa', $id_siswa);
        })
        ->where('scheduled_date', '>=', now())
        ->orderBy('scheduled_date', 'asc')
        ->first();

        $unreadMessages = KotakSurats::where('id_siswa', $id_siswa)
                                    ->whereNull('read_at')
                                    ->count();

        return view('siswa.home', compact('lastChat', 'jadwalTerdekat', 'unreadMessages'));
    }

    public function storeChat(Request $request)
    {
        $request->validate([
            'message' => 'required_if:file,null',
            'file' => 'nullable|image|max:2048'
        ]);

        $id_siswa = Auth::user()->id_siswa;
        $konseling = CounselingRequest::where('id_siswa', $id_siswa)->latest()->first();
        $chat = Chat::create([
            'konseling_id' => $konseling ? $konseling->id : null,
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
}