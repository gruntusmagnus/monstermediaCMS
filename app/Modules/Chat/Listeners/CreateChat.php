<?php

namespace App\Modules\Chat\Listeners;

use App\Employee;
use Illuminate\Auth\Events\Registered;

class CreateChat
{
    public function handle(Registered $event)
    {
        $user = $event->user->authenticable;

        if ($user instanceof Employee) {
            // employees does not have chats
            return;
        }

        $user->chat()
             ->create(['is_active' => true]);
    }
}