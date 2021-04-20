<?php

namespace App\Http\Requests\student_area;

use Illuminate\Foundation\Http\FormRequest;

class update_student_ extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return [
                'Student_id' => 'required|integer|exists:Students',       
                'roadmap' => 'required|min:1|max:2|integer|between:1,2',       
                'adv_id' => 'required|integer|exists:Users,id|different:Student_id',
                'dep_id' => 'required|integer|exists:Departments,dep_id',
                'sec_id' => 'required|integer|exists:Sections,sec_id',  
        ];
    }
}
