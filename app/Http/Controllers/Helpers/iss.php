<?php
namespace App\Http\Controllers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Student;
class iss extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function q($id)
    {
        $student =  Student::where('Student_id',$id)->first() ;

        $user=auth()->user();
      
       
        if($user->type == 1)
        {
            $student = Student::where('Student_id',$user->id)->first() ;
        }
        
        if(!$student)
        { 
            return response()->json(['err'=>'Not STUDENT OR NOT APPROVED YET'],401);
        }
        return ;
     }

}