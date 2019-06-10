<?php

namespace App\Modules\Chat\Listeners;

use App\Employee;
use Illuminate\Auth\Events\Login;

class ActivateChat
{
    public function handle(Login $event)
    {
        $user = $event->user->authenticable;

        if ($user instanceof Employee) {
            // employees does not have chats
            return;
        }

        if (!$user->chat) {
            $user->chat()
                 ->create(['is_active' => true]);
        } else {
            $user->chat->is_active = true;
            $user->chat->save();
        }
    }
}