<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konseling;
use App\Models\Chat;
use App\Events\ChatSent;
use App\Events\BotResponded;

class ChatController extends Controller
{
    public function index(Request $request){
        $konseling = Konseling::with('siswa','chats')->get();

        return view('gurubk.chat.index', compact('konseling'));
    }

    public function reply(Request $request, $id){
        $konseling = Konseling::findOrFail($id);

        $chat = Chat::create([
            'konseling_id' => $konseling->id_konseling,
            'sender_type' => 'gurubk',
            'message' => $request->message
        ]);

        event(new ChatSent($chat));

        return redirect()->back();
    }

    public function markRead($id){
        Chat::where('konseling_id',$id)
            ->where('sender_type','siswa')
            ->update(['is_read'=>true]);

        return response()->json(['status'=>'ok']);
    }

    public function botRespond(Chat $siswaChat){
        $existBot = Chat::where('konseling_id',$siswaChat->konseling_id)
                        ->where('sender_type','bot')
                        ->exists();

        if(!$existBot){
            $botMessage = Chat::create([
                'konseling_id' => $siswaChat->konseling_id,
                'sender_type' => 'bot',
                'message' => 'Terima kasih! Pesan Anda sudah diterima. Guru BK akan segera membalas.'
            ]);

            event(new BotResponded($botMessage));
        }
    }
}