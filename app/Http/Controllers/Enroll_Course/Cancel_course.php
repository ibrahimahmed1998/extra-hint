<?php
namespace App\Http\Controllers\Enroll_Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\enroll_;
use App\Models\enroll;
use App\Models\Student;

class Cancel_course extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); } 
   
    public function cancel_course(enroll_ $request)
    {
        $user=auth()->user();

        $student =Student::where('Student_id',$user->id)->first();
        if(!$student){ return response()->json(['err'=>'student not in his table'],201); }

        $check = enroll::where('ccode', $request->ccode)->where('year', $request->year)->
        where('semester', $request->semester)->where('Student_id', $student->Student_id);

        $test=$check->first();
        $not_sign=$check->where('signature',0)->first();
         
        if ($test) 
        {
            if($not_sign)
            {
                $check = enroll::where('ccode', $request->ccode)->where('year', $request->year)->
                where('semester', $request->semester)->where('Student_id', $student->Student_id)->delete();
                return response()->json(['success' => $request->ccode . " Canceled"], 201);
            }
            else
            {
                return response()->json(['err' => $request->ccode . " can't canceld at this TIME "], 201);
            }
           
        } else {
            return response()->json(['err' => $request->ccode . " Not Enrolled ! "], 400);
        }
    }
}