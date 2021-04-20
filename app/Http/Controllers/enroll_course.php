<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\student_area\Validate_SCT;
use App\Models\Pre_request;
use App\Models\Sct;

class enroll_course extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function SCT(Validate_SCT $request)  // student enroll course table
    {
        $x = Sct::where('ccode', $request->ccode)->where('year', $request->year)->where('semester', $request->semester)->where('Student_id', $request->Student_id)->first();

        if ($x) {
            return response()->json(['error' => "Student enrolled this Course Before in same SEMESTER , YEAR"], 400);
        } else {
            $pre_req = Pre_request::where('ccode', $request->ccode)->get();
            $p_r_counter = Pre_request::where('ccode', $request->ccode)->count();
            $counter = 0;

            foreach ($pre_req as $pr) {
                $pass = Sct::where('ccode', $pr->pr_ccode)->value('hpass');
                if ($pass == 1) {
                    $counter = $counter + 1;
                } else {
                    return response()->json(['error' => "Student not passed in pre-request " . $pr->pr_ccode], 400);
                }
            }

            if ($counter != $p_r_counter) {
                return response()->json(['error' => "Student can't enroll this course before it has pre-request and not passed "
                    . $pre_req->pr_code], 400);
            } else {
                $Sct = Sct::create(
                    [
                        'Student_id' => $request->Student_id,
                        'semester' => $request->semester,
                        'year' => $request->year,
                        'ccode' => $request->ccode,
                    ]
                );
                return response()->json(['message' => 'Student Has Course Rel Created Sucessfully '], 201);
            }
        }
    }

    public function cancel_course(Validate_SCT $request)
    {
        $check = Sct::where('ccode', $request->ccode)->where('year', $request->year)->where('semester', $request->semester)->where('Student_id', $request->Student_id)->first();

        if ($check) {
            $check = Sct::where('ccode', $request->ccode)->where('year', $request->year)->where('semester', $request->semester)->where('Student_id', $request->Student_id)->delete();
            return response()->json(['Sucessfully' => " Course Canceled Sucessfully"], 201);
        } else {
            return response()->json(['error' => "Course Not Found "], 400);
        }
    }
}
