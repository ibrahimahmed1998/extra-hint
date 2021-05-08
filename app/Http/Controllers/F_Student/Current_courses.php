<?php
namespace App\Http\Controllers\F_Student;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\Get_time;
use App\Models\enroll;
class Current_courses extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); } 
   
    public function current_courses()
    {
        $user = auth()->user();
        $gt=new Get_time();  $time=$gt->get_time();  
        $sem=$time['sem'];  
        $year=$time['year']; 


        $my_c = enroll::where('Student_id',$user->id)->where('year',$year)->where('semester',$sem)->get();
        return $my_c ; 
    }
}