<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\student_area\add_student_;
use App\Http\Requests\student_area\update_student_;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }

    public function add_student(add_student_  $request)
    {
        $check = Student::where('Student_id', $request->Student_id)->first();
        $advisor_counter = Student::where('adv_id', $request->adv_id)->get()->count();
        $is_adv = User::where('id', $request->adv_id)->value('type');
        $is_stu = User::where('id', $request->Student_id)->value('type');

        if ($is_stu != 1) {
            return response()->json(['error' => "this id is not student , please use real student id "], 400);
        }

        if ($is_adv != 2) {
            return response()->json(['error' => "this id is not advisor , please use real advisor id "], 400);
        }

        if ($check) {
            return response()->json(['error' => "Student is found in system "], 400);
        } else {
            if ($advisor_counter >= 10) {
                return response()->json(['error' => "please attach with another , advisor who's id =  " . $request->adv_id . " is completed"], 401);
            } else {
                Student::create(
                    [
                        'Student_id' => $request->Student_id,
                        'roadmap' => $request->roadmap,
                        'live_hour' => 12,
                        'total_gpa' => 0,
                        'current_lvl' => 1,
                        'adv_id' => $request->adv_id,
                        'dep_id' => $request->dep_id,
                        'sec_id' => $request->sec_id,
                    ]
                );
                return response()->json(['message' => 'Student Created Sucessfully '], 201);
            }
        }
    }

    public function update_student(update_student_ $request)
    {
        $lvl = new lvl_calc(); 
        $student = Student::where('Student_id', $request->Student_id);
        $class = new C_GPA();
         
        if ($student) 
        {
            $student->update(array(
              //'live_hour' => live hour calc,
                'c_gpa' =>$class->gpa_calc_f($request),
                'lvl' => $lvl->lvl_calc_f($request),
                'roadmap' => $request->roadmap,
                'adv_id' => $request->adv_id,
                'dep_id' => $request->dep_id,
                'sec_id' => $request->sec_id
            ));
            return response()->json(['message' => 'Student Updated Sucessfully '], 201);
        }
    }

    public function delete_student(add_student_  $request)
    {
        $request->validate(['Student_id' => 'required|exists:Students']);

        Student::where('Student_id', $request->Student_id)->delete();
        return response()->json(['Sucessfully' => " Student deleted"], 201);
    }
}
