<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class Update_u extends FormRequest
{
    public function authorize() {  return true; } 

    public function rules()
    {
        return 
        [
                'full_name' => 'min:3|max:50|string',
                'email' => 'email:rfc,dns',
                'phone' => 'numeric|regex:/(01)\d{9}/|digits:11',
                'type' => 'in:admin,student,advisor'
        ];
    }

}