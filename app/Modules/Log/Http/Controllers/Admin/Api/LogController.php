<?php

namespace App\Modules\Log\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Modules\Log\Http\Resources\LogResource;
use App\Modules\Log\Log;
use Illuminate\Support\Facades\Input;

class LogController extends Controller
{
    public function index()
    {
        $perPage = Input::get('per_page', 50);

        $events = Log::orderByDesc('created_at')
                     ->paginate($perPage);

        return LogResource::collection($events);
    }
}