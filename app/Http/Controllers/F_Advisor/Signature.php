<?php
namespace App\Http\Controllers\F_Advisor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\Get_time;
use App\Http\Requests\Signature_;
use App\Models\enroll;
use App\Models\User;
use Illuminate\Http\Request;

class Signature extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); } 

    public function signature(Request $req)
    {
        $req->validate([
            'Student_id' => 'required|integer|exists:Students',
            'ccode' => 'required|string|exists:Courses'
        ]);
      
        $gt=new Get_time();  $time=$gt->get_time(); 
        $sem=$time['sem'];  
        $year=$time['year']; 
        
        $ec = enroll::where('ccode', $req->ccode)->where('year', $year)->  /*////// ec = Enrolled Course //////*/
                where('semester', $sem)->where('Student_id',$req->Student_id);

        $ie=$ec->first();  /*////// ie = IS Enrolled ???? //////*/
        $user=auth()->user();

        if(!$ie) {   return response()->json(['err' => 'Not Enrolled yet ! '], 201);  }
       
        $ec->update(array('signature' => $user->id));

        $name=User::where('id',$req->Student_id)->value('first_name');
        return response()->json(['success' =>
        ["Course Code"=>$ie->ccode,
         "Name:"=>$name,
         'ID:'=>$ie->Student_id,
         'Signatured with:'=>$user->id
         ]], 200);
    }
}