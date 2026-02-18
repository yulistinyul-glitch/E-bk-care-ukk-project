<?php

namespace App\Listeners;

use App\Events\ChatSent;
use App\Http\Controllers\Gurubk\ChatController;

class SendBotResponse
{
    public function handle(ChatSent $event){
        if($event->chat->sender_type=='siswa'){
            app(ChatController::class)->botRespond($event->chat);
        }
    }
}