<?php
namespace App\Http\Controllers\AUTH_USERS;

use App\Http\Controllers\Auto\Refresh;
use App\Http\Controllers\Controller;;
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
            return response()->json(["token"=>$token ,
            "id"=>auth()->user()->id , 
            "first_name"=>auth()->user()->first_name , 
            "last_name"=>auth()->user()->last_name , 
            "phone"=>auth()->user()->phone , 
            "email"=>auth()->user()->email , 
            'type' => auth()->user()->type
            ]
         );
        } 
        else 
        {
            return response()->json(['err' => "Wrong Credintials , Try a valid E-mail or password"], 401);
        }
    }
}