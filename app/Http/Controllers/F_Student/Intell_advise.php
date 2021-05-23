<?php
namespace App\Http\Controllers\F_Student;
use App\Http\Controllers\Controller;
use App\Models\enroll;
use App\Models\Shc;
use App\Models\Student;
class Intell_advise extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' =>  []]);  }
    
    public function intell_advise()
    {
         $user=auth()->user();
         $s=Student::where('Student_id',$user->id)->first();
         $pass=[] ;  $not=[] ; 

         $c = Shc::where('dep_id', $s->Dep_id)->where('Sec_id', $s->Sec_id)->where('c_lvl',$s->lvl)->get(); // Courses current lvl 
         $cc = Shc::where('dep_id', $s->Dep_id)->where('Sec_id',0)->get(); // all shared Courses
         $pc = enroll::where('hpass',1)->where('Student_id', $s->Student_id)->get(); // pc  = PASSED COURSES

         if(!$c||!$cc||!$pc)
         {
             return response()->json(["err"=>"Courses have not uploaded WELL! "]);
         }
        for($i = 0; $i < $pc->count(); $i++){$pass[$i+1]=$pc[$i]->ccode;}
        for($i = 0; $i < $c->count();  $i++){$not[$i+1 ]=$c[$i]->ccode; }
        for($i = 0; $i < $cc->count(); $i++){$not[$i+1 ]=$cc[$i]->ccode;}
 
        for ($i=0; $i < sizeof($pass); $i++) 
        {
            if( $key = array_search( $pass[$i+1] , $not) )  {  unset($not[$key]);   }
        }

        return  $this->suggestion_courses($not,$s->roadmap);
    }
    
    public function suggestion_courses($not,$roadmap)
    {
        $new = [] ; 

        foreach ($not  as $key => $value   )  {     $new[]=$value ;   }
    
        for ($i=0; $i <sizeof($new); $i++) { $c[] = Shc::where('ccode',$new[$i])->first();  }
         
        if($roadmap == 1 ) { $array = collect($c)->sortBy('c_theoretical_ratio')->reverse()->toArray(); }
       
        else {  $array = collect($c)->sortBy('c_theoretical_ratio')->toArray(); }
    
        return $array ; 
     }
}