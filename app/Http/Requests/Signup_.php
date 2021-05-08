<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Signup_ extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|unique:Users|integer',      // min:3 firstName:Aya
            'first_name' => 'required|min:3|max:20|string',
            'last_name' => 'required|min:3|max:20|string',
            'phone' => 'required|numeric|regex:/(01)\d{9}/|digits:11|unique:users',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:8',
            'type' => 'required|between:1,3|integer', // 1 = admin , 2 = advisor  , 3 = student  
        ];
    }
}
