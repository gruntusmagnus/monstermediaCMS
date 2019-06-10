<?php

namespace App\Modules\Order\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Modules\Order\Http\Resources\OrderResource;

class KitchenController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::with('products')->where('completed', 0)->get());
    }
}