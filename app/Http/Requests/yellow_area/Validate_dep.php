<?php

namespace App\Http\Requests\yellow_area;

use Illuminate\Foundation\Http\FormRequest;

class Validate_dep extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return [
                'dname' => 'required|string|unique:Departments',       
                'dep_id' => 'required|integer|unique:Departments',       
        ];
    }
}
