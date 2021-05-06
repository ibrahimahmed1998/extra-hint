<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Signature_ extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        
        return
         [
            'Student_id'=>'required|integer|exists:Students',
            'semester' =>'required|integer|between:1,3',  
            'year' => 'required|integer|min:1900',
            'ccode' => 'required|string|exists:Courses'
         ];
    }
}
