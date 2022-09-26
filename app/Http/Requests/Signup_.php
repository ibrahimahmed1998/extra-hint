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
            'full_name' => 'required|min:3|max:50|string',
            'phone' => 'required|numeric|regex:/(01)\d{9}/|digits:11|unique:users',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:8',
            'type' => 'in:admin,student,advisor'
        ];
    }
}
