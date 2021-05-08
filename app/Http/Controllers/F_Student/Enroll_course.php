<?php
namespace App\Http\Controllers\F_Student;   
use App\Http\Controllers\Controller ;
use App\Http\Controllers\Helpers\enrolling;
use App\Http\Controllers\Helpers\Get_time;
use App\Http\Controllers\Helpers\ise;
use App\Http\Controllers\Helpers\iss;
use App\Models\Course;
use App\Models\Pre_request;
use App\Models\enroll;
use Illuminate\Http\Request;
 class Enroll_course extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); } 
    
    public function enroll_course(Request $req)  
    {
        $req->validate(['ccode' => 'required|string|exists:Courses']);
        $user=auth()->user();  
        $gt=new Get_time();  $time=$gt->get_time();  
        $iss = new iss(); if($q=$iss->qn()) {return $q;}
        $sum=0;      
        $counter = 0;
        $sem=$time['sem'];  
        $year=$time['year']; 
        $ise = new ise(); if($q=$ise->q($user->id,$req->ccode,$sem,$year)) {return $q;}
        $enrolling = new enrolling();  
        $prs = Pre_request::where('ccode', $req->ccode)->get();
        $pr_count=$prs->count();
        $current_enroll = Course::where('ccode',$req->ccode)->value('cch') ;
        $ecsy = enroll::where('semester', $sem)->where('year', $year)->get(); //enroled courses in SAME SEMESTER YEARS 

        foreach ($ecsy  as $c )  { $sum=$sum+Course::where('ccode',$c->ccode)->value('cch') ; }   
      
        $limit = $sum+$current_enroll ; 
        
        foreach ($prs as $pr) 
        {
            $is_pass = enroll::where('ccode', $pr->pr_ccode)->value('hpass');

            if ($is_pass == 1) {  $counter = $counter + 1; }
            else  {  return response()->json(['err'=> "not passed pre-request(".$pr->pr_ccode.")"], 400);   }
        }

        if ($counter != $pr_count) 
        {
            return response()->json(['err'=>"can't enroll before it's pre-request".$prs->pr_code], 400);
        }

        if( $sem == 3 && $limit<=6) {  return $enrolling->q($user->id,$req->ccode,$sem,$year);  }
       
        else if(($sem==2||$sem==1) && ($limit>19) ) // $req->force != 1 
           
          {return response()->json(['err' =>"Can't Enroll (".$req->ccode.") You Passed Limit Hours ! "], 400); }
           
        else if(($sem==2||$sem==1) && ($limit<=19) ) {return $enrolling->q($user->id,$req->ccode,$sem,$year);}                              
}}