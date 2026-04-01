<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CounselingRequest;
use App\Models\Chat;
use App\Events\ChatSent;
use App\Events\BotResponded;
use Illuminate\Broadcasting\BroadcastServiceProvider;

class ChatController extends Controller
{
    
    public function index(Request $request)
    {
        $konseling = CounselingRequest::with(['siswa', 'chats'])
                        ->whereIn('status', ['accepted', 'ongoing'])
                        ->latest()
                        ->get()
                        ->unique('id_siswa');

        $selectedChat = null;
        $allMessages = collect(); 

        if ($request->has('id')) {
            $selectedChat = CounselingRequest::with('siswa')
                            ->where('id', $request->id)
                            ->first();

            if ($selectedChat) {
                $allMessages = Chat::whereHas('konseling', function($q) use ($selectedChat) {
                    $q->where('id_siswa', $selectedChat->id_siswa);
                })->orderBy('created_at', 'asc')->get();

                Chat::where('konseling_id', $selectedChat->id)
                    ->where('sender_type', 'siswa')
                    ->update(['is_read' => true]);
            }
        }

        return view('gurubk.chat.index', compact('konseling', 'selectedChat', 'allMessages'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'file' => 'nullable|image|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('chat_files', 'public');
        }

        $chat = Chat::create([
            'konseling_id' => $id,
            'sender_type' => 'gurubk',
            'message' => $request->message,
            'file_path' => $filePath,
            'is_read' => false
        ]);

        broadcast(new ChatSent($chat))->toOthers();

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $chat->message,
                'file_url' => $filePath ? asset('storage/' . $chat->file_path) : null,
                'time' => $chat->created_at->format('H:i')
            ]);
        }

        return redirect()->back();
    }
}