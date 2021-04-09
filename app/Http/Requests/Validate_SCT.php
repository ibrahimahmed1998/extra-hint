<?php

namespace App\Http\Requests;

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
                'hmedterm_d' => ' integer',      
                'hlab_d' => '  integer',      
                'horal_d' =>'  integer',    
                'hclass_work_d' => ' integer',    
                'hfinal_d' =>' integer', 
                'htotal_d' => ' integer',    
                'hpass' => ' integer',    
                'semester' =>'required|integer', 
                'year' => 'required|integer',  
                'ccode' => 'required|string|exists:Courses,ccode',  
         ];
    }
}
