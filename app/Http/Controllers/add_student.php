<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\student_area\validate_student;
use App\Models\Student;
use App\Models\User;

class add_student extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }


    public function add_student(validate_student  $request)
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
                $Student = Student::create(
                    [
                        'Student_id' => $request->Student_id,
                        'roadmap' => $request->roadmap,
                        'live_hour' => $request->live_hour,
                        'total_gpa' => $request->total_gpa,
                        'current_lvl' => $request->current_lvl,
                        'adv_id' => $request->adv_id,
                        'dep_id' => $request->dep_id,
                        'sec_id' => $request->sec_id,
                    ]
                );
                return response()->json(['message' => 'Student Created Sucessfully '], 201);
            }
        }
    }
}
