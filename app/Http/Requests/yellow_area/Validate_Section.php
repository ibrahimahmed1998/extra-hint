<?php

namespace App\Http\Requests\yellow_area;

use Illuminate\Foundation\Http\FormRequest;

class Validate_Section extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return [
                 'Sec_id' => 'required|integer|unique:Sections',       
                'dep_id' => 'required|integer|exists:Departments,dep_id',       
                'sec_name' => 'required|string|unique:Sections',
               
        ];
    }
}
