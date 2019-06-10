<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname'     => 'max:255|regex:/^([^0-9 ]*)$/',
            'lastname'      => 'max:255|regex:/^([^0-9 ]*)$/',
            'email'         => 'max:255|email|unique:users',
            'password'      => 'min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/|confirmed',
            'sex'           => 'boolean',
            'note'          => 'max:2500'
        ];
    }
}
