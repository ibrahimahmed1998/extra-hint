<?php

namespace App\Http\Requests;

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
            'id' => 'required|integer',      
        ];
    }
}
