<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validate_attend extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ccode' => 'required|string|exists:Courses',
            'day_date' => 'required|date',
            'is_attend' => 'required|integer',
            'is_lecture' => 'integer',
         ];

         
    }
}
