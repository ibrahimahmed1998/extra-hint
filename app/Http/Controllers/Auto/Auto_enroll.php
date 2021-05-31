<?php
namespace App\Http\Controllers\Auto;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\enrolling;
use App\Http\Controllers\Helpers\Get_time;
use App\Models\enroll;
use App\Models\Shc;
use App\Models\Student;

class Auto_enroll extends Controller /************ Force *************/ 
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function auto_enroll()
    {
         $s=Student::where('lvl',1)->get();
         $gt=new Get_time();  $time=$gt->get_time();  $sem=$time['sem'];    $year=$time['year']; 

         $e = new enrolling(); 
         $arr = [] ; 
      
         for ($i=0; $i <$s->count() ; $i++) 
         { 

            $c = Shc::where('c_lvl',$s[$i]->lvl)->
            where('c_semester',$sem)->
            where('Sec_id',0)->
            where('dep_id',$s[$i]->Dep_id)->get();

           // dd($c);
            for ($j=0; $j <$c->count() ; $j++) 
            { 
                $arr[] = $e->q($s[$i]->Student_id,$c[$j]->ccode,$sem,$year) ; 
            
            }
         }

         return response()->json(['success'=>$arr]) ; 
    }

}