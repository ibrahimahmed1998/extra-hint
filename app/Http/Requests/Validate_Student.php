<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validate_Student extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return [
                'Student_id' => 'required|integer|exists:Users,id',       
                'roadmap' => 'required|min:1|max:2|integer|between:1,2',       
                'live_hour' => 'required|min:0|max:12|integer',
                'total_gpa' => 'between:0,99.99',
                'current_lvl' => 'required|min:1|max:4|integer',   
                'adv_id' => 'required|integer|exists:Users,id|different:Student_id',
                'dep_id' => 'required|integer|exists:Departments,dep_id',
                'sec_id' => 'required|integer|exists:Sections,sec_id',  
        ];
    }
}
