<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class Validate_Login extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

                'email' => 'required|email:rfc,dns',
                'password' => 'required|min:8',  // password accept Spaces

        ];
        // Wrong credintials, Please try to login with a valid e-mail and password
    }
}
