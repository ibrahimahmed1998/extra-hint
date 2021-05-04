<?php
namespace App\Http\Controllerss;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\enroll;
use Illuminate\Http\Request;

class GPA extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' =>  []]); } 
  
    public function gpa(Request $req)
    {
        $req->validate([
            'choice' =>'required|integer|between:1,2',
            'Student_id' => 'required|integer|exists:Students',
            'show_deg' => 'integer',
        ]);
        
        $year=enroll::where('year',$req->year)->first();
        $semester=enroll::where('semester',$req->semester)->first();
       

        $test=enroll::where('Student_id',$req->Student_id)->first();
        if(!$test) {return 0;} 
        if($req->choice==1)     // Semester_GPA
        {
            $req->validate(
                [
                'semester' => 'required|integer|between:1,3',
                'year' => 'required|integer|min:1900',
                ]);

                     
           if(!$year || !$semester)
           { return response()->json(['err' => "not Enrolled courses in: ".$req->year." or this semester"], 401); }

                $c = enroll::where('Student_id', $req->Student_id)->
                where('semester', $req->semester)->
                where('year', $req->year)->get();  
        }
        else if ($req->choice==2) // Cumulative_GPA
        {
            $c = enroll::where('Student_id', $req->Student_id)->get();  
        }

        $count = $c->count();
        $code = "";
        $points = 0.0;
        $Qulaity = 0.0;
        $total_quality=0;
        $total_cch=0;
        $arr = [];
        for ($i = 0; $i < $count; $i++) 
        {
            $cd = Course::where('ccode', $c[$i]->ccode)->value('dtotal');
            $cch = Course::where('ccode', $c[$i]->ccode)->value('cch');
            $sd = enroll::where('ccode', $c[$i]->ccode)->where('Student_id', $req->Student_id)->value('htotal_d');
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
            } else      if ($sd < $cd * 0.60) {
                $code = 'F';
                $points = 0.0;
                $Qulaity = $points * $cch;
            }

            $total_quality = $total_quality + $Qulaity;
            $total_cch = $total_cch + $cch;

            $arr[] =
                [
                    "Course code=" => $c[$i]->ccode,
                    "Grade=" => $code,
                    "Points=" => $points,
                    "degree" => $sd,
                ];
        }
        
        if($req->show_deg == 1 )
        {
            return response()->json([$arr ,'GPA:'=>substr($total_quality/$total_cch,0,5)])   ;
        }
            return substr($total_quality/$total_cch,0,5);  
    }
}