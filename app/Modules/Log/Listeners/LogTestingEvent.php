<?php

namespace App\Modules\Log\Listeners;

use App\Modules\Log\Log;

class LogTestingEvent
{
    public function handle($event)
    {
        Log::create([
                        'code'   => 'e123456',
                        'source' => 'testing',
                        'text'   => 'Toto je nova udalost, ktera by se mela propsat do tabulky! Udalost je typu ' . get_class($event)
                    ]);
    }
}