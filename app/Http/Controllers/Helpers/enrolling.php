<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\enroll;

class enrolling extends Controller
{
   
    public function q($id, $ccode, $sem, $year)
    {
      
        $sum = 0 ; 
        $ecsy = enroll::where('semester', $sem)->where('year', $year)->where('student_id', $id)->get();

        foreach ($ecsy  as $c) 
        {
            $sum = $sum + Course::where('ccode', $c->ccode)->value('cch');
        }
        
        $new_c =  Course::where('ccode', $ccode)->value('cch');
        
        enroll::create(
            [
                'student_id' => $id,
                'semester' => $sem,
                'year' => $year,
                'ccode' => $ccode,
                'signature' => 0,
                'created_at' => now()
            ]
        );

        // return response()->json(['success' => 'Enrolled '.$ccode ,"Enrolled Houres"=>$sum+$new_c], 201);

        return redirect("/user_update/$id")->with('msg',"Enrolled .$ccode ,Enrolled Houres=>$sum+$new_c");
    }
}
