<?php

namespace App\Modules\Log\Events;

use App\Modules\Log\Http\Resources\LogResource;
use App\Modules\Log\Log;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogEventCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;

    public function __construct(Log $message)
    {
        $this->message = LogResource::make($message);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('App.Log');
    }

    public function broadcastAs()
    {
        return 'event';
    }
}