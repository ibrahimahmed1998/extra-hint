<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class Validate_signup extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return [
                'id' => 'required|unique:Users|integer',      // min:3 firstName:Aya
                'full_name' => 'required|min:3|max:20|string',
                'email' => 'required|email:rfc,dns|unique:users',
                'password' => 'required|min:8',  
                'type' => 'required|between:1,3|integer', // 1 = admin , 2 = advisor  , 3 = student  
                'phone' => 'required|numeric|unique:users|regex:/(01)[0-9]{9}/',
        ];
    }
}
