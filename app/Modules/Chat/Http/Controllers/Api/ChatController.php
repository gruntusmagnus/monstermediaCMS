<?php

namespace App\Modules\Chat\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Chat\Chat;
use App\Modules\Chat\Http\Resources\ChatResource;
use App\User;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::active();

        $loggedUser = auth('api')->user()->authenticable;

        if ($loggedUser instanceof User) {
            $chats->where('customer_id', auth('api')->user()->authenticable->id);
        }

        return ChatResource::collection($chats->get());
    }

    public function create()
    {
        $chat = Chat::create([
                                 'is_active' => true
                             ]);

        return ChatResource::make($chat);
    }
}