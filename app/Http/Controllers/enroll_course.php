<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\enroll_;
use App\Http\Requests\signature_;
use App\Models\Course;
use App\Models\Pre_request;
use App\Models\enroll;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class enroll_course extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function enroll(enroll_ $request)  // student enroll course table
    {
        $user=auth()->user();
        if($user->type !=1 )
        {
            return response()->json(['err' => 'request for student only'], 201);
        }

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
                            'signature'=>0
                        ]
                    );
                    return response()->json(['success' => 'Enrolled ' . $request->ccode], 201);
                }  
             } 
        }
         else 
        {
            return response()->json(['err' => "enrolled " . $request->ccode . " before in same SEMESTER,YEAR"], 400);
        }
    }

    public function signature(signature_ $request)
    {
         
        $get = enroll::where('ccode', $request->ccode)->where('year', $request->year)->
                where('semester', $request->semester)->where('Student_id',$request->Student_id);

        $check=$get->first();

        $user=auth()->user();
        $adv=User::where('id',$user->id)->where('type',$user->type)->first();

        if($adv->type!=2 ) { return response()->json(['err'=>'You are not Universtiy stuff !'], 201); }

        if($check)
        {
            $get->update(array('signature' => $request->signature,));
            if($get->value('signature')!=$adv->id)
            {
                return response()->json(['warning' =>'please enter your id ' ], 401);
            }
            return response()->json(['success' =>'course  signatured' ], 401);
        }
        else
        {
            return response()->json(['err' => 'Not Enrolled yet ! '], 201);

        }
    }

    public function cancel_course(enroll_ $request)
    {
        $user=auth()->user();

        if($user->type !=1 )
        {
            return response()->json(['err' => 'request for student only'], 201);
        }

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