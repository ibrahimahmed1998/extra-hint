<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Test extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => ['test']]); }

    public function test(Request $req)
    {
        return $req ; 
    }
}