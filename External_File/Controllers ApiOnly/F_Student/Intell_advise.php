<?php
namespace App\Http\Controllers\F_Student;
use App\Http\Controllers\Controller;
use App\Models\enroll;
use App\Models\Shc;
use App\Models\Student;
use Illuminate\Http\Request;

class Intell_advise extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' =>  []]);  }
    
    public function intell_advise(Request $req)
    {
        
         $user=auth()->user();

         if($user->type != 1 )
         {
             if($user->type == 3)
             {
                 return response()->json(["err"=>"Student & Advisor Only Can Access "]);
             }
            $req->validate(["Student_id"=>"required|integer|exists:Students"]);
            $s=Student::where('Student_id',$req->Student_id)->first();
         }
         else
         {
            $s=Student::where('Student_id',$user->id)->first();
         }


         $pass=[] ;  $not=[] ; 

        // Courses current lvl 
         $c = Shc::where('dep_id',$s->Dep_id)->
                   where('Sec_id',$s->Sec_id)->
                   where('c_lvl',$s->lvl)->get();  
       
        // all shared Courses
         $cc = Shc::where('dep_id', $s->Dep_id)->where('Sec_id',0)->get(); 

         // pc  = PASSED COURSES
         $pc = enroll::where('hpass',1)->where('Student_id', $s->Student_id)->get(); 
         //dd($c);
         /*
         if(!$c->first()  || !$cc->first()   ) // || !$pc->first()
         {
             return response()->json(["err"=>"courses not found in Section"]);
         }
         */
        for($i = 0; $i < $pc->count(); $i++){$pass[$i+1]=$pc[$i]->ccode;}
        for($i = 0; $i < $c->count();  $i++){$not[$i+1 ]=$c[$i]->ccode; }
        for($i = 0; $i < $cc->count(); $i++){$not[$i+1 ]=$cc[$i]->ccode;}
 
        for ($i=0; $i < sizeof($pass); $i++) 
        {
            if( $key = array_search( $pass[$i+1],$not) )  {  unset($not[$key]);   }
        }
        
        $new = [] ; 
        foreach ($not  as $key => $value) 
         {     $new[]=$value ;   }
    
        for ($i=0; $i <sizeof($new); $i++) { $c[] = Shc::where('ccode',$new[$i])->first();  }
         
        if($s->roadmap == 1 ) { $array = collect($c)->sortBy('c_theoretical_ratio')->reverse()->toArray(); }
       
        else {  $array = collect($c)->sortBy('c_theoretical_ratio')->toArray(); }
    
        return $array ; 
     }
}