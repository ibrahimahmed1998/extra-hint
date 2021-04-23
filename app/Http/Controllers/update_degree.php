<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validate_SCT_degree;
use App\Models\Course;
use App\Models\Sct;

class update_degree extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>[ ] ]);
    }

    public function update_student_degree(Validate_SCT_degree $request)
    {
        $check = Sct::where('ccode', $request->ccode)->where('year', $request->year)->
        where('semester', $request->semester)->where('Student_id', $request->Student_id)->first();

        $update = Sct::where('ccode', $request->ccode)->where('year', $request->year)->
        where('semester', $request->semester)->where('Student_id', $request->Student_id);

        $course = Course::where('ccode', $request->ccode)->first();

        $class_work = $request->hmedterm_d + $request->hlab_d +  $request->horal_d;

        $total =   $class_work  +   $request->hfinal_d;

        if ($total >=  ($course->dtotal) * 0.60) {
            $is_pass = 1;
        } else {
            $is_pass = 0;
        }

        if ($check) 
        {
            if 
              (
                $request->hmedterm_d > $course->dmidterm || $request->hmedterm_d<0 ||
                $request->hlab_d > $course->dlab  || $request->hlab_d<0 ||
                $request->horal_d > $course->doral || $request->horal_d<0 ||
                $class_work > $course->dclass_work  || 
                $request->hfinal_d > $course->dfinal  || $request->hfinal_d<0 ||
                $total > $course->dtotal   
              ) 
              {
                return response()->json(['error' =>'Degrees > Course expected Degrees or < 0 '], 201);
              } 
            else 
              {
                $update->update(array(
                    'hmedterm_d' => $request->hmedterm_d,
                    'hlab_d' => $request->hlab_d,
                    'horal_d' =>  $request->horal_d,
                    'hclass_work_d' =>  $class_work,
                    'hfinal_d' => $request->hfinal_d,
                    'htotal_d' =>  $total,
                    'hpass' =>  $is_pass
                ));
              }
            return response()->json(['Success' => 'Degree has updated'], 201);
        }
         else 
        {
            return response()->json(['error' => 'Degree not updated , may doesn\'t enrolled '.
            $request->ccode.' at SEM:'.$request->semester.' YEAR:'.$request->year], 400);
        }
    }
}
