<?php

namespace App\Modules\Chat\Http\Requests;

use App\Employee;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        $chat = $this->route('chat');

        if (!$chat->is_active) {
            // cannot write to inactive chat
            return false;
        }

        if (auth('api')->check()) {
            $loggedUser = auth('api')->user()->authenticable;

            if ($loggedUser instanceof Employee) {
                return true;
            }

            return $chat->customer_id == $loggedUser->id;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'required',
            'source'  => 'required|in:customer,employee'
        ];
    }

    /**
     * Custom message for validation
     * @return array
     */
    public function messages()
    {
        return [
            'message.required' => 'Zpráva je povinná!',
        ];
    }
}