<?php

namespace App\Http\Requests;

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
            'Student_id'=>'required|integer|exists:Students',
            'roadmap' =>'integer|between:1,2',
            'adv_id' => 'integer|exists:Users,id|different:Student_id',
            'dep_id' => 'integer|exists:Departments,dep_id',
            'sec_id' => 'integer|exists:Sections,sec_id',
        ];
    }
}