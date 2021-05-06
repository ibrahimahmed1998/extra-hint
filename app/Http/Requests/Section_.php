<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Section_ extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return
         [
                'Sec_id' => 'required|integer|unique:Sections',       
                'dep_id' => 'required|integer|exists:Departments,dep_id',       
                'sec_name' => 'required|string|unique:Sections',
               
        ];
    }
}
