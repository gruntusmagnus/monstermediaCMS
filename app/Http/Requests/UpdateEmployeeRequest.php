<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'string|max:255|unique:employees',
            'firstname'     => 'max:255|regex:/^([^0-9 ]*)$/',
            'lastname'      => 'max:255|regex:/^([^0-9 ]*)$/',
            'email'         => 'max:255|email|unique:employees',
            'password'      => 'min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/|confirmed',
            'active'        => 'boolean'
        ];
    }
}
