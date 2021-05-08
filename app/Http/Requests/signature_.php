<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Signature_ extends FormRequest
{
    public function authorize(){  return true;}

    public function rules()
    {   
        return
         [
            'Student_id'=>'required|integer|exists:Students',
            'ccode' => 'required|string|exists:Courses'
         ];
    }
}
