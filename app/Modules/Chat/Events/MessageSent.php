<?php

namespace App\Modules\Chat\Events;

use App\Modules\Chat\Http\Resources\MessageResource;
use App\Modules\Chat\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;

    public function __construct(Message $message)
    {
        $this->message = MessageResource::make($message);
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.Chat.' . $this->message->chat_id);
    }

    public function broadcastAs()
    {
        return 'message';
    }
}