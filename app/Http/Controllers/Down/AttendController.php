<?php

namespace App\Http\Controllers\Down;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Stu;
use App\Http\Requests\student_area\validate_student;
use App\Http\Requests\validate_attend;
use App\Models\Attend;
use App\Models\Sct;
use App\Models\Student;
use App\Models\User;

class AttendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }
 
    public function attend(validate_attend $request)
    {
        $user = auth()->user();
        $check_stu=Student::where('Student_id',$user->id)->first();
        $check_sct=Sct::where('Student_id',$user->id)->where('ccode',$request->ccode)->first();

        $is_attend=Attend::where('Student_id',$user->id)
                          ->where('ccode',$request->ccode)
                          ->where('day_date',$request->day_date)->where('is_attend',$request->is_attend)
                          ->where('is_lecture', $request->is_lecture)->first();

        if($is_attend)
        {
            return response()->json(['error' => "Duplicated !"], 400);
        }
        if( ! $check_stu )
        {
            return response()->json(['error' => "this is student id , but not approved yet"], 400);
        }
        if ($user->type != 1 )
        {   
            return response()->json(['error' => "this id is not student , please use real student id "], 400);
        }

        if (!$check_sct)
        {
            return response()->json(['error' => "student does not enroll in this course "], 400);
        }

        else
        {
            $Attend = Attend::create(
                [
                    'Student_id' =>  $user->id,
                    'ccode' => $request->ccode,
                    'day_date' => $request->day_date,
                    'is_attend' => $request->is_attend,
                    'is_lecture' => $request->is_lecture,
                 ]
            );
            return response()->json(['message' => 'Attended'], 201);
        }
       
    }

}

