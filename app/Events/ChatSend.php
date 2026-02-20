<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Chat;

class ChatSent implements ShouldBroadcast {
    use Dispatchable, SerializesModels;

    public $chat;

    public function __construct(Chat $chat){
        $this->chat = $chat;
    }

    public function broadcastOn(){
        return new Channel('chat.'.$this->chat->konseling_id);
    }
}