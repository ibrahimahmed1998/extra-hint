<?php
namespace App\Http\Controllers\Enroll_Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\Signature_;
use App\Models\enroll;

class Signature extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); } 

    public function signature(Signature_ $req)
    {
        $ec = enroll::where('ccode', $req->ccode)->where('year', $req->year)->  /*////// ec = Enrolled Course //////*/
                where('semester', $req->semester)->where('Student_id',$req->Student_id);

        $ie=$ec->first();  /*////// ie = IS Enrolled ???? //////*/
        $user=auth()->user();

        if($user->type != 2) { return response()->json(['err'=>'You are not Universtiy stuff !'], 201); }

        if(!$ie) {   return response()->json(['err' => 'Not Enrolled yet ! '], 201);  }
       
        $ec->update(array('signature' => $user->id));

        return response()->json(['success' =>$ec->ccode.' Signatured for Student '.$ec->Student_id], 401);
    }
}