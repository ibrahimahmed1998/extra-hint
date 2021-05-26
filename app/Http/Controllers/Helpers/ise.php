<?php
namespace App\Http\Controllers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\enroll;
class ise extends Controller        // IS ENROLLED  ? 
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function q($id,$ccode,$sem,$year)
    {
        $is_enrolled = enroll::where('ccode', $ccode)->
                               where('year',$year)->
                               where('semester',$sem)->
                               where('Student_id',$id)->first();

        if($is_enrolled)
        { 
            return response()->json(['err' => $ccode." enrolled before in same SEMESTER,YEAR"],400);
        }

        return ;
     }    
}