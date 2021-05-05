<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Search_user extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' =>[] ]);}
  
    public function search_user(Request $req)  
    {
        $req->validate(['all' => 'numeric|min:1|not_in:0']);
        $user=0;

        if ($req->first_name) 
        {
            $req->validate(['first_name' => 'string|exists:Users']);
            $user = User::where('first_name', $req->first_name)->get();

        } 
        else if ( $req->first_name  && $req->last_name ) 
        {
            $req->validate(['last_name' => 'string|exists:Users','first_name' => 'string|exists:Users']);
            $user = User::where('first_name', $req->first_name)->where('last_name', $req->last_name)->get();

        } 
        else if ($req->id)
         {
            $req->validate(['id' => 'integer|exists:Users']);
            $user = User::where('id', $req->id)->get();

        }
         else if ($req->email) 
         {
            $req->validate(['email' => 'email:rfc,dns|exists:Users']);
            $user = User::where('email', $req->email)->get();

        }
         else if ($req->phone) 
         {
            $req->validate(['email' => 'email:rfc,dns|exists:Users']);
            $user = User::where('phone', $req->phone)->get();

        }
         else if ($req->all) 
        {
            $user = User::all();
        }

        if(!$user){ return response()->json(['err'=>"enter choice"]);}
        return response()->json(['success' =>  $user], 201);
    }
}