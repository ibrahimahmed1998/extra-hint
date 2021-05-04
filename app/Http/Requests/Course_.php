<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Course_ extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return [
 
                'ccode' => 'required|string|unique:Courses',      
                'cname' => 'required|string|unique:Courses',      
                'cch' => 'required|integer',      
                'dmidterm' =>'required|integer',    
                'dlab' => 'required|integer',    
                'doral' =>'required|integer',    
                'dfinal' => 'required|integer',    
                'instructor' => 'string',            
        ];
    }
}
