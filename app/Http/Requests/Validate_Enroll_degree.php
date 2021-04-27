<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validate_Enroll_degree extends FormRequest
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

            'hmedterm_d' => 'required|integer',      
            'hlab_d' => 'required|integer',      
            'horal_d' => 'required|integer',      
            'hfinal_d' => 'required|integer',    
      
        ];
    }
}
