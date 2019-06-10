<?php

namespace App\Modules\Chat\Listeners;

use Illuminate\Auth\Events\Logout;

class DeactivateChat
{
    public function handle(Logout $event)
    {
        $user = $event->user->authenticable;


        if ($user->chat) {
            $user->chat->is_active = false;
            $user->chat->save();
        }
    }
}