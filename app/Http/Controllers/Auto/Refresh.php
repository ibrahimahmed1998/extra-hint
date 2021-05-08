<?php
namespace App\Http\Controllers\Auto;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auto\Auto_node\Lvl;
use App\Http\Controllers\Auto\Auto_node\Live_hour;
use App\Http\Controllers\Auto\Auto_node\GPA;
use App\Models\Student;

class Auto_student extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function refresh()
    {
        $c1 = new Auto_enroll(); $c1->auto_enroll();
        $c2 = new Auto_degree(); $c2->auto__degree();
        $c3 = new Auto_cancel(); $c3->auto_cancel();
        $c4 = new Auto_student();$c4->auto_student();
    } 
}