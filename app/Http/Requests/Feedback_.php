<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Feedback_ extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ccode' => 'required|string|exists:Courses',
            'fheader' => 'required|string',
            'fbody' => 'required|string',
            'fvote' => 'integer',
         ];
    }
}
