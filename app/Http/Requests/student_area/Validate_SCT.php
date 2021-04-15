<?php

namespace App\Http\Requests\student_area;

use Illuminate\Foundation\Http\FormRequest;

class Validate_SCT extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        
        return [
 
                'Student_id' => 'required|string|exists:Students,student_id',      
                'semester' =>'required|integer', 
                'year' => 'required|integer',  
                'ccode' => 'required|string|exists:Courses,ccode',  
         ];
    }
}
