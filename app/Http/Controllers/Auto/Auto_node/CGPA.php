<?php
namespace App\Http\Controllers\Auto\Auto_node;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\enroll;

class CGPA extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' =>  []]); } 
  
    public function cgpa($id) 
    {
        $c = enroll::where('Student_id',$id)->get(); 

        $points = 0.0;            $Qulaity = 0.0;
        $total_quality=0;         $total_cch=0;
        $code = "";

        for ($i=0; $i <$c->count() ; $i++)   { $arr[] = $c[$i]; }
              
        for ($i=0; $i<$c->count() ;  $i++) 
        {
            $cd = Course::where('ccode', $arr[$i]->ccode)->value('dtotal'); // Course Degree
        
            $cch = Course::where('ccode', $arr[$i]->ccode)->value('cch'); // Course Credit Hours
          
            $sd = $arr[$i]->htotal_d; // Student Degree

            if ($sd >= $cd * 0.90) 
            {
                $code = 'A';
                $points = 4.0;
                $Qulaity = $points * $cch;
            } 
            else if ($sd >= $cd * 0.85 && $sd <  $cd * 0.90) 
            {
                $code = 'A-';
                $points = 3.67;
                $Qulaity = $points * $cch;
            } 
            else if ($sd >= $cd * 0.80 && $sd <  $cd * 0.85)
             {
                $code = 'B+';
                $points = 3.33;
                $Qulaity = $points * $cch;
            } 
            else if ($sd >= $cd * 0.75 && $sd <  $cd * 0.80) 
            {
                $code = 'B';
                $points = 3.00;
                $Qulaity = $points * $cch;
            } 
            else if ($sd >= $cd * 0.70 && $sd <  $cd * 0.75) 
            {
                $code = 'C+';
                $points = 2.67;
                $Qulaity = $points * $cch;
            } 
            else if ($sd >= $cd * 0.65 && $sd <  $cd * 0.70) 
            {
                $code = 'C';
                $points = 2.33;
                $Qulaity = $points * $cch;
            } 
            else if ($sd >= $cd * 0.60 && $sd <  $cd * 0.65)
             {
                $code = 'D';
                $points = 2.0;
                $Qulaity = $points * $cch;
            }
             else if ($sd < $cd * 0.60) 
            {
                $code = 'F';
                $points = 0.0;
                $Qulaity = $points * $cch;
            }

            $total_quality = $total_quality + $Qulaity;
            $total_cch = $total_cch + $cch;

            $res[] =
                [
                    "Course code=" => $c[$i]->ccode,
                    "Grade=" => $code,
                    "Points=" => $points,
                    "degree" => $sd,
                ];
        }
           // return print_r($res)."\n".substr($total_quality/$total_cch,0,5);  
           return substr($total_quality/$total_cch,0,5); 
    }
}