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
       
    }
}
