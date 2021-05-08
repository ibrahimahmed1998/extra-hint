<?php
namespace App\Http\Controllers\F_Student;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\Get_time;
use App\Http\Controllers\Helpers\iss;
use App\Models\enroll;
use Illuminate\Http\Request;
class Cancel_course extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); } 
   
    public function cancel_course(Request $req)
    {
        $req->validate(['ccode'=>'required|string|exists:Courses']);
        $user=auth()->user();
        $gt=new Get_time();  $time=$gt->get_time();  $sem=$time['sem'];    $year=$time['year']; 
        $iss = new iss(); if($q=$iss->q($user->id)) {return $q;}
        
        $ie = enroll::where('ccode', $req->ccode)->where('year', $year)->
        where('semester', $sem)->where('Student_id', $user->id);
 
        $test=$ie->first();
        $not_sign=$ie->where('signature',0)->first();
         
        if ($test) 
        {
            if($not_sign)
            {
                enroll::where('ccode', $req->ccode)->where('year', $year)->
                where('semester', $sem)->where('Student_id', $user->id)->delete();
                return response()->json(['success'=>$req->ccode." Canceled"],201);
            }
            else{return response()->json(['err' => $req->ccode . " can't canceld at this TIME "], 201); }
        } 
        else{return response()->json(['err'=>$req->ccode." Not Enrolled !"], 400);}}}     