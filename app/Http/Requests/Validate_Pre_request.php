<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validate_Pre_request extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return 
        [
                'ccode' => 'required|string|exists:Courses,ccode',      
                'pr_ccode' => 'required|string|different:ccode|exists:Courses,ccode',          
        ];
    }
}
