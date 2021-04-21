<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Sct;
use Illuminate\Http\Request;

class C_GPA extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }

    public function gpa_calc_f(Request $request)
    {
        $request->validate([  'Student_id' => 'required|integer|exists:Students' ]);
           
        $c = Sct::where('Student_id', $request->Student_id)->get();   
                
        $count = $c->count();
        $code = "";
        $points = 0.0;
        $Qulaity = 0.0;
        $sum=0;
        $total_cch=0;
        for ($i = 0; $i < $count; $i++) 
        {
            $cd = Course::where('ccode', $c[$i]->ccode)->value('dtotal');
            $cch = Course::where('ccode', $c[$i]->ccode)->value('cch');
            $sd = Sct::where('ccode', $c[$i]->ccode)->where('Student_id', $request->Student_id)->value('htotal_d');

                if ($sd >= $cd * 0.90) 
                {
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
                    $Qulaity= $points * $cch ; 
                } else if ($sd >= $cd * 0.70 && $sd <  $cd * 0.75) {
                    $code = 'C+';
                    $points = 2.67;
                    $Qulaity= $points * $cch ; 
                } else if ($sd >= $cd * 0.65 && $sd <  $cd * 0.70) {
                    $code = 'C';
                    $points = 2.33;
                    $Qulaity= $points * $cch ; 
                } else if ($sd >= $cd * 0.60 && $sd <  $cd * 0.65) {
                    $code = 'D';
                    $points = 2.0;
                    $Qulaity= $points * $cch ; 
                } else      if ($sd < $cd * 0.60) {
                    $code = 'F';
                    $points = 0.0;
                    $Qulaity= $points * $cch ; 
                }
            
                $arr[] = 
                [
                 "Course code=" => $c[$i]->ccode,
                 "Grade=" => $code,
                 "Points=" => $points,
                 "degree"=>$sd,
                ];

            $sum= $sum + $Qulaity;
            $total_cch=$total_cch+$cch;
        }
        return response()->json(["C.GPA:"=>$sum/$total_cch]);
      //  return  $arr;
    }
}
