<?php
namespace App\Http\Controllers\Auto;
use App\Http\Controllers\Controller;
use App\Models\enroll;

class Auto_enroll extends Controller /************ Force *************/ 
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function auto_enroll()
    {
         
    }
}