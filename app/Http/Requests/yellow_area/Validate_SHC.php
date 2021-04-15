<?php

namespace App\Http\Requests\yellow_area;

use Illuminate\Foundation\Http\FormRequest;

class Validate_SHC extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        
        return [
                'dep_id' => 'required|string|exists:Departments',      
                'Sec_id' => 'required|string|exists:Sections',      
                'ccode' => 'required|string|exists:Courses',      
                'c_theoretical_ratio' =>'required|integer',    
                'c_elective' => 'required|integer',    
                'c_semester' =>'required|integer',    
                'c_lvl' => 'required|integer',    
         ];
    }
}
