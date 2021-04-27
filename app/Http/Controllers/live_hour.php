<?php
namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\enroll;
use App\Models\Student;
use Illuminate\Http\Request;

class live_hour extends Controller
{
    public function live_hourf(Request $request)
    {
        Student::where('Student_id', $request->Student_id)->first();
        $live_hours = 12 ; 
        $enrolled = enroll::where('Student_id', $request->Student_id)->get();
        for ($i = 0; $i < $enrolled->count(); $i++) 
        {
            for ($j =$i+1; $j < $enrolled->count(); $j++)
             {
                if ($enrolled[$i]->ccode == $enrolled[$j]->ccode) 
                { 
                    $c=Course::where('ccode',$enrolled[$i]->ccode)->value('cch');
                    $live_hours=$live_hours-$c;
                }
            }
        }
        return $live_hours;
    }
}

                    //print($enrolled[$i]->ccode." == ". $enrolled[$j]->ccode."\n");
