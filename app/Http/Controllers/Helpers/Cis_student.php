<?php
namespace App\Http\Controllers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Student;
class Cis_student extends Controller  
{
    public function is_student($id)
    {
        $student =  Student::where('user_id',$id)->first() ;

        $user=auth()->user();
      
        if($user->type == 'student')
        {
            $student = Student::where('user_id',$user->id)->first() ;
        }
        
        if(!$student)
        { 
            return response()->json(['err'=>'Not STUDENT OR NOT APPROVED YET'],401);
        }
        return ;
     }
}