<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Enter_degree_ extends FormRequest
{
    public function authorize()  { return true; }

    public function rules()
    {
        return [
            'Student_id' => 'required|string|exists:Students,student_id',      
            'semester' =>'required|integer', 
            'year' => 'required|integer|min:1900',
            'ccode' => 'required|string|exists:Courses,ccode',    
        ];
    }
}
