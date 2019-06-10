<?php

namespace App\Modules\Chat\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Modules\Chat\Chat;
use App\Modules\Chat\Events\ChatActivated;
use App\Modules\Chat\Events\MessageSent;
use App\Modules\Chat\Http\Requests\MessageRequest;
use App\Modules\Chat\Http\Resources\MessageResource;
use App\Modules\Chat\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Chat $chat)
    {
        $perPage = 15;
        $messages = $chat->messages()->with('customer', 'employee')
                         ->orderByDesc('created_at');

        return MessageResource::collection($messages->paginate($perPage));
    }

    public function create(MessageRequest $request, Chat $chat)
    {
        $data = $request->all();
        $loggedUser = auth('api')->user()->authenticable;
        $column = $this->getUserColumn($request);

        $message = Message::create([
                                       'chat_id' => $chat->id,
                                       'content' => $data['message'],
                                       $column   => $loggedUser->id
                                   ]);
        event(new MessageSent($message));

        return MessageResource::make($message);
    }

    public function read(Request $request, Chat $chat)
    {
        $ignoredColumn = $this->getUserColumn($request);

        $chat->messages()
             ->whereNull($ignoredColumn)
             ->update(['read' => true]);
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    protected function getUserColumn(Request $request)
    {
        $loggedUser = auth('api')->user()->authenticable;

        if ($request->source == 'employee' && $loggedUser instanceof Employee) {
            $ignoredColumn = 'employee_id';
        } else {
            $ignoredColumn = 'customer_id';
        }

        return $ignoredColumn;
    }
}