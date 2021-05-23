<?php
namespace App\Http\Controllers\F_Advisor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\Get_time;
use App\Models\Attend;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Attends extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  [' ']]);
    }

    public function attends(Request $req)
    {
        $user =auth()->user();

        $req->validate(['token'=>'required|string|exists:sessions']);

        $Session = Session::where('token',$req->token);
        $now = $Session->first();
        $ccode = $Session->value('ccode');

        $t=Carbon::now(); $date=substr($t,0,10); 

        
        $is_found = Attend::where('Student_id',$user->id)->
                            where('ccode',$ccode)->
                            where('is_lec',$now->is_lec)->
                            where('date',$date)->first();

        if($is_found)
        {
            return response()->json(['err'=> $user->first_name." you can't attend twice at  : ".$ccode ]);

        }

        

        Attend::create(
            [
                'Student_id' =>  $user->id,
                'ccode' => $ccode,
                'is_lec'=> $now->is_lec ,
                'date'=> $date ,

            ]
        );

        return response()->json(['success'=> $user->first_name." is attend ccode : ".$ccode ]);
    
      
    }

}
