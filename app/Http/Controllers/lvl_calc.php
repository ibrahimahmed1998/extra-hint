<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Sct;
use App\Models\Student;
use Illuminate\Http\Request;

class lvl_calc extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function lvl_calc_f(Request $request)
    {
        $request->validate(['Student_id' => 'required|exists:Students']);

        $passed_courses = Sct::where('hpass', 1)->where('Student_id', $request->Student_id)->get();

        $sum = 0;
        foreach ($passed_courses as $p) {
            $sum = $sum + Course::where('ccode', $p->ccode)->value('cch');
        }

        $lvl = 1;

        Student::where('Student_id', $request->Student_id)->first();

        if ($sum >= 0 && $sum < 33) {  $lvl = 1; } 
        else if ($sum  >= 33 && $sum < 67) { $lvl = 2; }
        else if ($sum  >= 67 && $sum < 100) { $lvl =  3; }
        else if ($sum  >= 100 && $sum < 134) {$lvl =  4;}
        else if ($sum >= 134) 
        {
            response()->json(['message' => 'student was graduated  '], 201);
        } 
        else 
        {
            return response()->json(['error' => 'level calculator has error  '], 400);
        }
        
        return $lvl;
    }
}

/*  
if  OLD
    ($sum >= 0 && $sum < 33) {
            $student->where('student_id', $request->student_id)->update(['current_lvl' => 1]);
        } else if ($sum  >= 33 && $sum < 67) {
            $student->where('student_id', $request->student_id)->update(['current_lvl' => 2]);
        } else if ($sum  >= 67 && $sum < 100) {
            $student->where('student_id', $request->student_id)->update(['current_lvl' => 3]);
        } else if ($sum  >= 100 && $sum < 134) {
            $student->where('student_id', $request->student_id)->update(['current_lvl' => 4]);
        } else if ($sum >= 134) {
            response()->json(['message' => 'student was graduated  '], 201);
        } else {
            return response()->json(['error' => 'level calculator has error  '], 400);
        }
        //return response()->json(['message' => 'Student Current lvl = ' . $student->current_lvl], 201);
        return $student->current_lvl;
    }
*/