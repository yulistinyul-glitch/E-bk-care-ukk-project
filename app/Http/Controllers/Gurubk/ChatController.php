<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CounselingRequest;
use App\Models\Chat;
use App\Events\ChatSent;
use App\Events\BotResponded;

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
        $request->validate(['message' => 'required']);
        $chat = Chat::create([
            'konseling_id' => $id,
            'sender_type' => 'gurubk',
            'message' => $request->message,
            'is_read' => false
        ]);

        broadcast(new ChatSent($chat))->toOthers();
        return redirect()->back();
    }
}