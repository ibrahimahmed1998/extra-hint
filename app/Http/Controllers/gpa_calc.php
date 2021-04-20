<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class gpa_calc extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }
    
    public function gpa_calc(Request $request)
    {
        /*  sugges */
    }
}
