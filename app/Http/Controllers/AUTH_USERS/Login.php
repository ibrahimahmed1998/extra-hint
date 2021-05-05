<?php
namespace App\Http\Controllers\AUTH_USERS;
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
        $req->validate(['email' => 'required|email:rfc,dns', 'password' => 'required|min:8']);

        $credentials = $req->only('email', 'password');
        
      if ($token = auth()->attempt($credentials)) 
        {
            $this->respondWithToken($token);
            return response()->json(["token"=>$token ,"name"=>auth()->user()->first_name , 'type' => auth()->user()->type] );
        } 
        else 
        {
            return response()->json(['err' => "Wrong Credintials , Try a valid E-mail or password"], 401);
        }
    }
}