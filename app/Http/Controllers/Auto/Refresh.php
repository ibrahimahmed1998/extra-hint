<?php
namespace App\Http\Controllers\Auto;
use App\Http\Controllers\Controller;
class Refresh extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function refresh()
    {
        $c1 = new Auto_enroll(); $c1->auto_enroll();
        $c3 = new Auto_cancel(); $c3->auto_cancel();
        $c4 = new Auto_student();$c4->auto_student();
    } 


   
}

