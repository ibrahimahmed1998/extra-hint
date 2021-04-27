<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class enroll_ extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        
        return [
 
                'semester' =>'required|integer|between:1,3',  // summer = 3 
                'year' => 'required|integer',  
                'ccode' => 'required|string|exists:Courses,ccode',  
         ];
    }
}
