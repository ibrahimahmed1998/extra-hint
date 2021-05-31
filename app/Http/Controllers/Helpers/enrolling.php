<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\enroll;

class enrolling extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function q($id, $ccode, $sem, $year)
    {
        $sum = 0 ; 
        $ecsy = enroll::where('semester', $sem)->where('year', $year)->where('Student_id', $id)->get();

        foreach ($ecsy  as $c) 
        {
            $sum = $sum + Course::where('ccode', $c->ccode)->value('cch');
        }
        $new_c =  Course::where('ccode', $ccode)->value('cch');
        enroll::create(
            [
                'Student_id' => $id,
                'semester' => $sem,
                'year' => $year,
                'ccode' => $ccode,
                'signature' => 0,
                'created_at' => now()
            ]
        );

        return response()->json(['success' => 'Enrolled '.$ccode ,"Enrolled Houres"=>$sum+$new_c], 201);
    }
}
