<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
 
class intell_alg extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }
    
    public function suggestion_courses( $request)
    {
        /*  suggestion based on multipule things like [roadmap , short_path , best score ] */
    }
}