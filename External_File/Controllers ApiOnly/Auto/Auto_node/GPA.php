<?php

namespace App\Http\Controllers\Auto\Auto_node;

use App\Http\Controllers\Auto\Auto_degree;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\enroll;
use Illuminate\Support\Facades\DB;

class GPA extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }

    public function gpa($id, $msg, $year, $semester) // $msg = sgpa || cgpa
    {
        $points = 0.0;             $Qulaity = 0.0;
        $total_quality = 0;               $total_cch = 0;              $code = "";
        $form = [];  

        $auto = new Auto_degree();            $auto->auto_degree();

        $test = enroll::where('Student_id', $id)->first();

        if (!$test) { return 0; }     // STUDENT NOT ENROLLED COURSES 

        else 
        {
            $c = enroll::where('Student_id', $id)->get();

            if ($msg == "sgpa") 
            {
                $y = enroll::where('year', $year)->first();
                $s = enroll::where('semester', $semester)->first();

        /*
                if (!$y || !$s)
                 {
                    return response()->json(['err' => "not Enrolled in: " . $year . " or this semester".$semester], 401);
                 }
        */
            
                $test_sem = enroll::where('Student_id', $id)->where('semester', $semester)->where('year', $year)->first();

                if (!$test_sem)
                 {
                    return response()->json(['err' => "not Enrolled in SEM: ".$semester." YEAR: ".$year], 401);
                }

                $c = enroll::where('Student_id', $id)->where('semester', $semester)->where('year', $year)->get();
            }

            for ($i = 0; $i < $c->count(); $i++)   {   $arr[] = $c[$i];  }

            for ($i = 0; $i < $c->count(); $i++) {
                $cd = Course::where('ccode', $arr[$i]->ccode)->value('dtotal'); // Course Degree

                $cch = Course::where('ccode', $arr[$i]->ccode)->value('cch'); // Course Credit Hours

                $sd = $arr[$i]->htotal_d;        // Student Degree

                if ($sd >= $cd * 0.90) {
                    $code = 'A';
                    $points = 4.0;
                    $Qulaity = $points * $cch;
                } else if ($sd >= $cd * 0.85 && $sd <  $cd * 0.90) {
                    $code = 'A-';
                    $points = 3.67;
                    $Qulaity = $points * $cch;
                } else if ($sd >= $cd * 0.80 && $sd <  $cd * 0.85) {
                    $code = 'B+';
                    $points = 3.33;
                    $Qulaity = $points * $cch;
                } else if ($sd >= $cd * 0.75 && $sd <  $cd * 0.80) {
                    $code = 'B';
                    $points = 3.00;
                    $Qulaity = $points * $cch;
                } else if ($sd >= $cd * 0.70 && $sd <  $cd * 0.75) {
                    $code = 'C+';
                    $points = 2.67;
                    $Qulaity = $points * $cch;
                } else if ($sd >= $cd * 0.65 && $sd <  $cd * 0.70) {
                    $code = 'C';
                    $points = 2.33;
                    $Qulaity = $points * $cch;
                } else if ($sd >= $cd * 0.60 && $sd <  $cd * 0.65) {
                    $code = 'D';
                    $points = 2.0;
                    $Qulaity = $points * $cch;
                } else if ($sd < $cd * 0.60) {
                    $code = 'F';
                    $points = 0.0;
                    $Qulaity = $points * $cch;
                }

                $total_quality = $total_quality + $Qulaity;
                $total_cch = $total_cch + $cch;

                /*UNSELECTED
                       'hpass' => $c[$i]->hpass,
                       'hmedterm_d' => $c[$i]->year,
                       'hlab_d' => $c[$i]->hlab_d,
                       'horal_d' => $c[$i]->horal_d,
                       'hclass_work_d' => $c[$i]->hclass_work_d,
                       'hfinal_d' => $c[$i]->hfinal_d
                */

                $form[] =
                    [
                        "Course code=" => $c[$i]->ccode,
                        "Grade=" => $code,
                        "Points=" => $points,
                        "degree" => $sd,
                    ];

            }

            $cgpa = ["CGPA = " => substr($total_quality / $total_cch, 0, 5)];
 
            if ($msg == "cgpa")  {  return $cgpa;  }
           
            if ($msg == "sgpa") // FOR BYAN EL NGAAAAAAAAAAAAAAA7777777
            {
                return response()->json(["year"=>$year,
                                         "semester"=>$semester,
                                         "Courses"=>$form,$msg.":"=>substr($total_quality/$total_cch,0,5)]);
            }

            return substr($total_quality / $total_cch, 0, 5);
        }
    }
}
