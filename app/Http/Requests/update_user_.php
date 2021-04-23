<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class update_user_ extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return [
                'id' => 'required|exists:Users|integer',      // min:3 firstName:Aya
                'full_name' => 'required|min:3|max:20|string',
                'email' => 'required|email:rfc,dns',
                'type' => 'required|between:1,3|integer', // 1 = admin , 2 = advisor  , 3 = student  
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
        ];
    }
}
