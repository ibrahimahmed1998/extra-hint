<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class Validate_edit_profile extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
        [
            'firstname' => 'required|min:3|max:20|alpha ',      // min:3 firstName:Aya
            'lastname' => 'required|min:3|max:20|alpha',
            'phone' => 'required|numeric|regex:/(01)[0-9]{9}/', // must be unique if other users use it
            'birthdate' => 'required|date',     //YYYY/MM/DD
            //token
        ];
    }
}
