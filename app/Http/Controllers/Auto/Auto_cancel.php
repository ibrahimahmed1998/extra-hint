<?php
namespace App\Http\Controllers\Auto;
use App\Http\Controllers\Controller;
use App\Models\enroll;

class Auto_cancel extends Controller /************ Force *************/ 
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function auto_cancel()
    {
        $get = enroll::where('signature',0)->get();

        //  $get = enroll::where('signature',0)->delete();           test it plz 
        for ($i = 0; $i < $get->count(); $i++) 
        {
            $get[$i]->delete();
        }
    }
}