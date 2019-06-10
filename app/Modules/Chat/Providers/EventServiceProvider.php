<?php

namespace App\Modules\Chat\Providers;

use App\Modules\Chat\Listeners\ActivateChat;
use App\Modules\Chat\Listeners\CreateChat;
use App\Modules\Chat\Listeners\DeactivateChat;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;



class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            CreateChat::class,
        ],
        Logout::class     => [
            DeactivateChat::class
        ],
        Login::class => [
            ActivateChat::class
        ]
    ];


}