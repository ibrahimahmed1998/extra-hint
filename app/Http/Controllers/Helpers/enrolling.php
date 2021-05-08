<?php
namespace App\Http\Controllers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\enroll;
class enrolling extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function q($id,$ccode,$sem,$year)
    {
        enroll::create(
            [   
            'Student_id'=>$id,
            'semester'=>$sem,
            'year'=>$year,
            'ccode'=>$ccode,
            'signature'=>0,
            'created_at'=>now() 
            ]);

            return response()->json(['success'=>'Enrolled '.$ccode], 201);  
    }
}