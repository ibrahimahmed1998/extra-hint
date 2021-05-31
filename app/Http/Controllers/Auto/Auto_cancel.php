<?php
namespace App\Http\Controllers\Auto;
use App\Http\Controllers\Controller;
use App\Models\enroll;
use App\Models\Student;

class Auto_cancel extends Controller /************ Force *************/ 
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function auto_cancel()
    {
       // $get = enroll::where('signature',0)->get();
       // $s = Student::where('lvl',1)->get();
       $s = Student::where('lvl',1)->first();
       
        $get = enroll::where('signature',0)->where('Student_id',$s->Student_id)->get();

        //  $get = enroll::where('signature',0)->delete();           test it plz 

        $arr = []  ;
        for ($i = 0; $i < $get->count(); $i++) 
        {
            $arr [] =  ["CCODE"=>$get[$i]->ccode , "ID"=>$s->Student_id] ; 
            $get[$i]->where('Student_id',$s->Student_id)->delete();
            
        }

        return response()->json(['success'=>["deleted ccode"=>$arr]]) ; 

    }
}