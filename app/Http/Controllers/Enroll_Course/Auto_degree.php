<?php

namespace App\Http\Controllers\Enroll_Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\enroll;

class Auto_degree extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function auto_degree()
    {
        $get = enroll::all();

        for ($i = 0; $i < $get->count(); $i++) 
        {
            $course = Course::where('ccode', $get[$i]->ccode)->first();

            $classwork = ($get[$i]->hmedterm_d + $get[$i]->hlab_d + $get[$i]->horal_d);
            $total = ($get[$i]->hclass_work_d + $get[$i]->hfinal_d);

            if ($total >=  ($course->dtotal) * 0.60) {   $is_pass = 1; } 
              
            else {  $is_pass = 0;  }
            
            $update = enroll::where('ccode', $get[$i]->ccode)->where('year', $get[$i]->year)->
            where('semester', $get[$i]->semester)->where('Student_id', $get[$i]->Student_id);

            $update->update(array("hpass" => $is_pass, "htotal_d" => $total, "hclass_work_d" => $classwork));
        }
    }
}