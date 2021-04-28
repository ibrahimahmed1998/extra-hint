<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class signature_ extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        
        return [
            'signature' => 'required|integer',
            'Student_id'=>'required|integer|exists:Students',
            'semester' =>'required|integer|between:1,3',  
            'year' => 'required|integer',  
            'ccode' => 'required|string|exists:Courses'
         ];
    }
}
