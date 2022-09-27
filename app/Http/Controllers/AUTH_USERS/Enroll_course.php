<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller ;
use App\Http\Controllers\Helpers\Cis_enrolled;
use App\Http\Controllers\Helpers\Cis_student;
use App\Http\Controllers\Helpers\enrolling;
use App\Http\Controllers\Helpers\Get_time;
use App\Models\Course;
use App\Models\Pre_request;
use App\Models\enroll;
use App\Models\User;
use Illuminate\Http\Request;

 class Enroll_course extends Controller
{    
    public function enroll_course2(Request $req)  
    {
       
        $user = User::where('id',$req->user_id)->first();   //$user=auth()->user(); 

        $req->validate(['ccode'=>'string|exists:Courses']);

        $gt=new Get_time();      $time=$gt->get_time(); 
        $sem=$time['sem'];       $year=$time['year'];  
        $sum=0; $counter = 0;

        $iss = new Cis_student(); 
        
        if( $q=$iss->is_student($user->id) ) {return $q;}

        $ise = new Cis_enrolled();
        if($qq=$ise->q($user->id,$req->ccode,$sem,$year)) {return $qq;}

        

        $enrolling = new enrolling(); 

        $prs = Pre_request::where('ccode', $req->ccode)->get();
        $pr_count=$prs->count();

        $current_enroll = Course::where('ccode',$req->ccode)->value('cch') ;


        //enroled courses in SAME SEMESTER YEARS 
        $ecsy = enroll::where('semester', $sem)->
                        where('year', $year)->
                        where('student_id', $user->id)->get();

        foreach ($ecsy  as $c )  { $sum=$sum+Course::where('ccode',$c->ccode)->value('cch') ; }   
      
        $limit = $sum+$current_enroll ; 
        

        foreach ($prs as $pr) 
        {
            $is_pass = enroll::where('ccode', $pr->pr_ccode)->value('hpass');

            if ($is_pass == 1) {  $counter = $counter + 1; }
            else  { return response()->json(['err'=> "not passed pre-request(".$pr->pr_ccode.")"], 400);   }
        }



        if ($counter != $pr_count) 
        {
            return response()->json(['err'=>"can't enroll before it's pre-request".$prs->pr_code], 400);
        }

       
        if( $sem == 3 && $limit<=6) {   return $enrolling->q($user->id,$req->ccode,$sem,$year); }

        else if(($sem==2||$sem==1) && ($limit>19) ) // $req->force != 1 
           {
            return  response()->json(
                ['err' =>"Can't Enroll !",
                 "ccode"=>$req->ccode  , 
                 "[ccode+old] houres"=>$sum +$current_enroll,
                 "Current Hours:"=>$sum,
                 "Limited Hours"=>19], 400);}
           
        else if(($sem==2||$sem==1) && ($limit<=19) ) 
        { 
            return $enrolling->q($user->id,$req->ccode,$sem,$year);
         }                              
}}