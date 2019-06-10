<?php

namespace App\Modules\Log\Providers;

use App\Modules\Log\Listeners\LogTestingEvent;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        // todo tu budou definovany jednotlive udalosti a patricne listenery
        // listener by mel jen vytvorit zaznam v tabulce log, patricna udalost pro ucely broadcastovani bude uvolnena automaticky
        // pro ilustraci viz LogTestingEvent

        Logout::class => [
            LogTestingEvent::class
        ],
        Login::class  => [
            LogTestingEvent::class
        ]
    ];
}