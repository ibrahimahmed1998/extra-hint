<?php
namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\enroll;
use App\Models\Student;
use Illuminate\Http\Request;

class Live_hour extends Controller
{
    public function __construct() {   $this->middleware('auth:api', ['except' => []]); }

    public function live_hour(Request $req)
    {
        Student::where('Student_id', $req->Student_id)->first();
        $live_hours = 12 ; 
        $enrolled = enroll::where('Student_id', $req->Student_id)->get();
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