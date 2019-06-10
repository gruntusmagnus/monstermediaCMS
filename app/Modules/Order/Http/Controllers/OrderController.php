<?php

namespace App\Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Order\Http\Resources\OrderResource;
use App\Modules\Order\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //v objemu CyberDog můžeme posílat všechna data a řešit filtraci až ve Vue
        //return CategoryResource::collection(Category::paginate($paginate));
        return OrderResource::collection(Order::get());
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderProducts = $order->products()
                               ->get();
        return view('order::order.show', compact('order', 'orderProducts'));
    }

    public function detail()
    {
//        $activeOrder = Auth::user()->authenticable->orders()
//                                                  ->orderBy('id', 'ASC')
//                                                  ->first();
//        $selectedProducts = $activeOrder->products()
//                                        ->get();
        return view('order::order.index');//, compact('selectedProducts', 'activeOrder'));
    }

    public function create(Request $request)
    {
        $order = new Order($request);
        $order->save();
    }
}
