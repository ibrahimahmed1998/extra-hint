<?php
namespace App\Http\Controllers\F_Student;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Pre_request;
use App\Models\enroll;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Enroll_course extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); } 
    
    public function enroll_course(Request $req)  // student enroll course table
    {
        $req->validate(['ccode' => 'required|string|exists:Courses']);
        $user=auth()->user();    $t=Carbon::now();
       
        $sem=0;  $year=substr($t,0,4); $month = substr($t,5,2);
        $sem1 =['09','10','11','00'];  $sem2= ['01','02','03','05']; $sem3 =['06','07','08','00']; 
        $sum=0;

        $pre_req = Pre_request::where('ccode', $req->ccode)->get();
        $pr_count = Pre_request::where('ccode', $req->ccode)->count();
        $counter = 0;

        for ($i=0; $i < 4; $i++) 
        { 
            if($month===$sem1[$i]){$sem=1;}  else if($month===$sem2[$i]){$sem=2;}  else if($month===$sem3[$i]){$sem=3;} 
        }
 
        $is_stu =Student::where('Student_id',$user->id)->first();

        if(!$is_stu) { return response()->json(['err'=>'student not in his table'],201); }

        $is_enrolled = enroll::where('ccode', $req->ccode)->where('year',$year)->
        where('semester',$sem)->where('Student_id',$user->id)->first();

        $current_enroll = Course::where('ccode',$req->ccode)->value('cch') ;
        $ecsy = enroll::where('semester', $sem)->where('year', $year)->get(); //enroled courses in SAME SEMESTER YEARS 

       // dd($ecsy);
        if (!$is_enrolled) // not enrolld before
        {
           foreach ($ecsy  as $c )    
           { $sum=$sum+Course::where('ccode',$c->ccode)->value('cch') ; }

           $limit = $sum+$current_enroll ; 
           
           foreach ($pre_req as $pr) 
           {
             $is_pass = enroll::where('ccode', $pr->pr_ccode)->value('hpass');

             if ($is_pass == 1) {  $counter = $counter + 1; }
             else  {  return response()->json(['err'=> "not passed pre-request(".$pr->pr_ccode.")"], 400);   }
           }

           if ($counter != $pr_count) 
            {
                return response()->json(['err' => "can't enroll before it's pre-request". $pre_req->pr_code], 400);
            }

            if( $sem == 3 && $limit<=6)
            {
                enroll::create([   
                        'Student_id'=>$user->id,'semester'=>$sem,'year'=>$year,'ccode'=>$req->ccode,
                        'signature'=>0,'created_at'=>now()  ]);

                return response()->json(['success' => 'Student Enrolled '.$req->ccode], 201);
            }

            else if(($sem==2||$sem==1) && ($limit>=19) ) // $req->force != 1 
             {
                return response()->json(['err' =>"Can't Enroll (".$req->ccode.") at (SEM:".$sem.") You have ".$sum." Hours ! "], 400);
             }

            else if(($sem==2||$sem==1) && ($limit<=19) ) 
             { 
                enroll::create([ 'Student_id' => $user->id, 'semester' => $sem,'year' => $year, 
                                 'ccode' => $req->ccode,'signature'=>0,  'created_at'=> now() ]);
                       
                return response()->json(['success'=>'Enrolled '.$req->ccode], 201);
             }}   
        else {return response()->json(['err' => $req->ccode." enrolled before in same SEMESTER,YEAR"],400);}      
}}