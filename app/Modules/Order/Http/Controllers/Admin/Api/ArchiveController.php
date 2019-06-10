<?php

namespace App\Modules\Order\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Modules\Order\Http\Resources\OrderResource;
use App\Modules\Order\Order;

class ArchiveController extends Controller
{

    public function index()
    {
        return OrderResource::collection(Order::with('user')->where('completed', 1)->get());
    }
}