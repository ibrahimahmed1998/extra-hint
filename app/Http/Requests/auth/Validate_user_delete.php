<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class Validate_delete extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return 
        [
            'id' => 'required|integer|exists:Users',      
        ];
    }
}
