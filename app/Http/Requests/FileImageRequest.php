<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =[
            //
        ];

        $count = count($this->input('items')) -1;
        foreach(range(0,$count) as $index){
            $rules["items.$index"]='mimes:txt,pdf,png,jpg,jpeg,doc,docx,ppt,pptx,xls,xlsx';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        foreach($this->file('items') as $key => $value){
            $messages["items.$key.mimes"] = "All files must be of type: values";
        }

        return $messages;
    }
}

