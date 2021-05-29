<?php
namespace App\Http\Controllers\AUTH_USERS;

use App\Http\Controllers\Auto\Refresh;
use App\Http\Controllers\Controller;
use App\Models\Student;

;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' => ['login']]); }
   
    protected function respondWithToken($token)
        {
            return response()->json(['token' => $token, 'expires_in' => auth()->factory()->getTTL() * 60  ]);
        }
        
    public function login(Request $req)
    {
        $refresh = new Refresh();  $refresh->refresh_f();

        $req->validate(['email' => 'required|email:rfc,dns', 'password' => 'required|min:8']);

        $credentials = $req->only('email', 'password');
        
      //  dd($req->email);

        
      if ($token = auth()->attempt($credentials)) 
        {
            $this->respondWithToken($token);
          //  return redirect('/');

            $user =auth()->user();

            if($user->type==1)
            {   
                $s = Student::where('Student_id',$user->id)->first();

                return response()->json(["token"=>$token ,
                "first_name"=> $user->first_name , 
                "last_name"=> $user->last_name , 
                "phone"=> $user->phone , 
                "email"=> $user->email , 
                'type' =>  $user->type , 
                "S_data"=>$s
                ]
             );

               // 'Student_data'=> $s ,

            }   
           // return $user ; 
            return response()->json(["token"=>$token ,
            "id"=>auth()->user()->id , 
            "first_name"=> $user->first_name , 
            "last_name"=> $user->last_name , 
            "phone"=> $user->phone , 
            "email"=> $user->email , 
            'type' =>  $user->type , 
            ]
         );
        } 
        else 
        {
            return response()->json(['err' => "Wrong Credintials , Try a valid E-mail or password"], 401);
        }
    }
}