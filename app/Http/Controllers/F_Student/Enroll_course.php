<?php
namespace App\Http\Controllers\F_Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\enroll_;
use App\Models\Course;
use App\Models\Pre_request;
use App\Models\enroll;
use App\Models\Student;

class Enroll_course extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); } 
    
    public function enroll_course(Enroll_ $request)  // student enroll course table
    {
        $user=auth()->user();
 
        $check =Student::where('Student_id',$user->id)->first();
        if(!$check){ return response()->json(['err'=>'student not in his table'],201); }

        $x = enroll::where('ccode', $request->ccode)->where('year',$request->year)->
        where('semester', $request->semester)->where('Student_id',$user->id)->first();

        if (!$x) // not enrolld before
        {
            $ecsy = enroll::where('semester', $request->semester)->    //enroled courses in SAME SEMESTER YEARS
                where('year', $request->year)->get();
           
            $sum=0;
            foreach ($ecsy  as $c )
             {
               $sum=$sum+Course::where('ccode',$c->ccode)->value('cch') ;
             }

             if($request->semester == 3 )
             {
                if($sum<6)
                {
                    enroll::create(
                        [
                            'Student_id' => $user->id, 'semester' => $request->semester,
                            'year' => $request->year, 'ccode' => $request->ccode,
                            'signature'=> 0
                        ]
                    );
                    return response()->json(['success' => 'Student Enrolled ' . $request->ccode], 201);
                }
             }
             //dd($sum);
             if($sum>19 && $request->force != 1)
             {
                return response()->json(['err' =>"Can't Enroll More ... You enrolled ".$sum." Hours ! "], 400);
             }
           
            $pre_req = Pre_request::where('ccode', $request->ccode)->get();
            $pr_count = Pre_request::where('ccode', $request->ccode)->count();
            $counter = 0;

            foreach ($pre_req as $pr) {
                $is_pass = enroll::where('ccode', $pr->pr_ccode)->value('hpass');
                if ($is_pass == 1) {
                    $counter = $counter + 1;
                } else 
                {
                    return response()->json(['err' => "Student not passed in pre-request " . $pr->pr_ccode], 400);
                }
            }

            if ($counter != $pr_count) 
            {
                return response()->json(['err' => "can't enroll before it's pre-request". $pre_req->pr_code], 400);
            }
             else
             { 
                $sum=$sum+Course::where('ccode',$request->ccode)->value('cch');
                if($sum>19  && $request->force != 1 )
                {
                   return response()->json(['err' =>"Can't Enroll More ... You enrolled ".$sum." Hours ! "], 400);
                }
                else // sum
                {
                    enroll::create(
                        [
                            'Student_id' => $user->id, 'semester' => $request->semester,
                            'year' => $request->year, 'ccode' => $request->ccode,
                            'signature'=>0, 
                        ]
                    );
                    return response()->json(['success'=>'Enrolled '.$request->ccode], 201);
                }  
             } 
        }
         else 
        {
            return response()->json(['err' => "enrolled " . $request->ccode . " before in same SEMESTER,YEAR"], 400);
        }
    }
}