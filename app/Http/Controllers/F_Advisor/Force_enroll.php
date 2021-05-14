<?php
namespace App\Http\Controllers\F_Advisor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Signature_;
use App\Models\enroll;

class Edit_enroll extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); } 

    public function edit_enroll(Signature_ $req)
    {
       
    }
}