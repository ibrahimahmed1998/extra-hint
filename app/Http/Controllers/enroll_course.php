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
        $x = Sct::where('ccode', $request->ccode)->
                  where('year', $request->year)->
                  where('semester', $request->semester)->
                  where('Student_id', $request->Student_id)->first();

        if (!$x) // not enrolld before
         {
            $pre_req = Pre_request::where('ccode', $request->ccode)->get();
            $pr_count = Pre_request::where('ccode', $request->ccode)->count();
            $counter = 0;

            foreach ($pre_req as $pr) 
            {
                $is_pass = Sct::where('ccode', $pr->pr_ccode)->value('hpass');
                if ($is_pass == 1) 
                 {
                    $counter = $counter + 1;
                 } 
                else 
                 {
                    return response()->json(['error' => "Student not passed in pre-request " . $pr->pr_ccode], 400);
                 }
            }

            if ($counter != $pr_count) 
            {
                return response()->json(['error' => "Student can't enroll course before it's pre-request"
                    . $pre_req->pr_code], 400);
            } else
             {
                Sct::create(
                    [
                        'Student_id' => $request->Student_id,'semester' => $request->semester,
                        'year' => $request->year,'ccode' => $request->ccode,
                    ]
                );
                return response()->json(['success' => 'Student Enrolled '.$request->ccode], 201);
            }
         } 
         else
         {
            return response()->json(['error' => "Student enrolled ".$request->ccode." before in same SEMESTER,YEAR"], 400);
         }
    }

    public function cancel_course(Validate_SCT $request)
    {
        $check = Sct::where('ccode', $request->ccode)->
        where('year', $request->year)->where('semester', $request->semester)->where('Student_id', $request->Student_id)->first();

        if ($check) 
        {
            $check = Sct::where('ccode', $request->ccode)->
                          where('year', $request->year)->
                          where('semester', $request->semester)->
                          where('Student_id', $request->Student_id)->delete();
            return response()->json(['success' =>$request->ccode." Canceled"], 201);
        }
         else 
        {
            return response()->json(['error' => $request->ccode." Not Enrolled ! "], 400);
        }
    }
}