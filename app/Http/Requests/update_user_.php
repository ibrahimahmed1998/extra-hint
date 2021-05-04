<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Update_user_ extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return [
                'id' => 'required|exists:Users|integer',      
                'first_name' => 'required|min:3|max:20|string',
                'last_name' => 'required|min:3|max:20|string',
                'email' => 'required|email:rfc,dns',
                'type' => 'required|between:1,3|integer', // 1 = admin , 2 = advisor  , 3 = student  
                'phone' => 'required|numeric|regex:/(01)\d{9}/|digits:11',

        ];
    }
}
