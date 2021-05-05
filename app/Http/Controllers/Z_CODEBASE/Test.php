<?php
namespace App\Http\Controllers\Z_CODEBASE;

use App\Http\Controllers\Auto\Auto_node\GPA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Test extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => ['test']]); }

    public function test( )
    {
     $c = new GPA();
    return  $c->gpa(200,'sgpa',2020,1);  
    }
}