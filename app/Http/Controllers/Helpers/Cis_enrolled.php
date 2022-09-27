<?php
namespace App\Http\Controllers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\enroll;
class Cis_enrolled extends Controller        
{
    public function q($id,$ccode,$sem,$year)
    {
        $is_enrolled = enroll::where('ccode', $ccode)->
                               where('year',$year)->
                               where('semester',$sem)->
                               where('student_id',$id)->first();

        if($is_enrolled)
        { 
            // return response()->json(['err' => $ccode." enrolled before in same SEMESTER,YEAR"],400);
            return redirect("/user_update/$id")->with('msg',"$ccode enrolled before in same SEMESTER,YEAR");
        }

        return ;
     }    
}