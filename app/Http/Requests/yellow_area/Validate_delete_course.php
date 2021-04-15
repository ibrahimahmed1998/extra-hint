<?php

namespace App\Http\Requests\yellow_area;

use Illuminate\Foundation\Http\FormRequest;

class Validate_delete_course extends FormRequest
{
    public function authorize()
    {
        return true;

    }

    public function rules()
    {
        return [
                'ccode' => 'required|string|exists:Courses',           
        ];
    }
}
