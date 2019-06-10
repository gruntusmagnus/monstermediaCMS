<?php

namespace App\Modules\Chat\Events;

use App\Modules\Chat\Chat;
use App\Modules\Chat\Http\Resources\MessageResource;
use App\Modules\Chat\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatActivated implements ShouldBroadcast
{
    public $chat;

    public function __construct(Chat $chat)
    {
        $chat->load('customer');

        $this->chat = $chat;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.Chat.Active');
    }

    public function broadcastAs()
    {
        return 'chat';
    }
}