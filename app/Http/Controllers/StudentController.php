<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }

    public function update_student(Request $request)
    {
        $request->validate(
            [
            'Student_id' => 'required|integer|exists:Students',
            'roadmap' => 'required|min:1|max:2|integer|between:1,2',
            'adv_id' => 'required|integer|exists:Users,id|different:Student_id',
            'dep_id' => 'required|integer|exists:Departments,dep_id',
            'sec_id' => 'required|integer|exists:Sections,sec_id',
            ]);

        $student = Student::where('Student_id', $request->Student_id);
        $lvl = new lvl_calc();
        $C_GPA = new GPA();

        if ($student) 
        {
            $student->update(array(
                //'live_hour' => live hour calc,
                'c_gpa' => $C_GPA->gpa_calc($request),
                'lvl' => $lvl->lvl_calc_f($request),
                'roadmap' => $request->roadmap,
                'adv_id' => $request->adv_id,
                'dep_id' => $request->dep_id,
                'sec_id' => $request->sec_id
            ));
            return response()->json(['Success' => 'Student Updated'], 201);
        }
    }

    public function delete_student(Request  $request)
    {
        $request->validate(['Student_id' => 'required|integer|exists:Students']);

        Student::where('Student_id', $request->Student_id)->delete();

        return response()->json(['Success'=>"Student deleted"], 201);
    }

    public function list_students()
    {
        $s = Student::all();
        return response()->json(['all students' =>  $s], 201);
    }

    public function student_search(Request $request)
    {
        $request->validate(['Student_id' => 'required|integer|exists:Students']);

        $s = Student::where('Student_id',$request->Student_id)->first();
        return response()->json(['student' => $s], 201);
    }

}