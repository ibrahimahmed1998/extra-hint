<?php
namespace App\Http\Controllers\F_Advisor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\Get_time;
use App\Http\Requests\Signature_;
use App\Models\enroll;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Layer extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); } 

    public function Layer_f(Request $req)
    {
        $user = auth()->user();
 
        $t=Carbon::now(); $date=substr($t,0,10); 
         
         $req->validate(['value'=>'required|integer|between:0,1' ,
                        'is_lec'=>'required|integer|between:0,1',
                        'ccode' => 'required|string|exists:Courses',      

                       ]);
       

         if($user->type!=2) {return response()->json(['err'=>"not advisor"]); }

        if($req->value==1)
        {     
           $req->validate(['token'=>'required|string|unique:sessions',]);


            $ccode = Session::where('ccode',$req->ccode)->first();
            if($ccode){ return response()->json(['err'=>"must delete last tokens with this courses "]);  }
            
            Session::create(['layer_value'=>$req->value,'token'=>$req->token,
            'ccode'=>$req->ccode,'is_lec'=>$req->is_lec , 'date'=>$date] );

            return response()->json(['success'=>"session created"]); 
        }

        if($req->value==0)
        {
            Session::where('layer_value',1)->where('token',$req->token)->delete();


            return response()->json(['success'=>"session deleted"]); 
        }
    }
}