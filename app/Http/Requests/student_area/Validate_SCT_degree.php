<?php

namespace App\Http\Requests\student_area;

use Illuminate\Foundation\Http\FormRequest;

class Validate_SCT_degree extends FormRequest
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
