<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validate_change_pass extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return 
        [
            'password' => 'required|min:8',
            'new_pass' => 'required|min:8|required_with:conifrm_new_pass|same:conifrm_new_pass',        ];
    }
}
