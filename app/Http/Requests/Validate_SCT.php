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
        /*'Student_id' => 'required|integer|exists:Users,id',       
                'roadmap' => 'required|min:1|max:2|integer|between:1,2',       
                'live_hour' => 'required|min:0|max:12|integer',
                'total_gpa' => 'between:0,99.99',
                'current_lvl' => 'required|min:1|max:4|integer',   
                'adv_id' => 'required|integer|exists:Users,id|different:Student_id',
                'dep_id' => 'required|integer|exists:Departments,dep_id',
                'sec_id' => 'required|integer|exists:Sections,sec_id',  
                */
 
        return [
 
                'Student_id' => 'required|string|exists:Students,student_id',      
                'hmedterm_d' => 'required|integer',      
                'hlab_d' => 'required|integer',      
                'horal_d' =>'required |integer',    
                'hclass_work_d' => 'required|integer',    
                'hfinal_d' =>'required|integer', 
                'htotal_d' => 'required|integer',    
                'hpass' => 'required|integer',    
                'semester' =>'required|integer', 
                'year' => 'required|integer',  
                'ccode' => 'required|string|exists:Courses,ccode',  
         ];
    }
}
