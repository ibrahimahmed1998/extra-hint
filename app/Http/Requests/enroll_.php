<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Enroll_ extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        
        return [
 
                'semester' =>'required|integer|between:1,3',  // summer = 3 
                'year' => 'required|integer|min:1900',
                'ccode' => 'required|string|exists:Courses,ccode',  
         ];
    }
}
