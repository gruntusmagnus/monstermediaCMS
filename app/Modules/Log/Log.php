<?php

namespace App\Modules\Log;

use App\Modules\Log\Events\LogEventCreated;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['code', 'source', 'text'];

    protected $dispatchesEvents = [
        'created' => LogEventCreated::class
    ];
}
