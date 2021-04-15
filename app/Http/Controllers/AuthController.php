<?php

namespace App\Http\Controllers;
 

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\Validate_change_pass;
use App\Http\Requests\auth\Validate_delete;
use App\Http\Requests\auth\Validate_Login;
use App\Http\Requests\auth\Validate_signup;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup', 'Student', 'delete_user']]);
    }

    public function signup(Validate_signup  $request)
    {
        $user = User::create(
            [
                'id' => $request->id,
                'full_name' => $request->full_name,
                'password' => $request->password,
                'email' => $request->email,
                'type' => $request->type,
                'phone' => $request->phone,
            ]
        );
        return response()->json(['message' => 'Successfully sign up'], 201);
    }


    public function login(Validate_Login $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = auth()->attempt($credentials)) { {
                $this->respondWithToken($token);
            }
            return $this->respondWithToken($token);
        } else {
            return response()->json(['error' => "Wrong credintials, Please try to login with a valid e-mail or password"], 401);
        }
    }

    public function me()        //  Get the authenticated User. 
    {
        return response()->json(auth()->user());
    }

    public function refresh()   // Refresh a token.
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)         // Get the token array structure. 
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function delete_user(Validate_delete  $request)
    {
        /*if (auth()->type == 3) 
        {}
        else { return response()->json(['error' => ' You are not adminstrator '], 400 ); }
        */

        if (User::find($request->id)) {
            User::find($request->id)->delete();
            return response()->json(['message' => 'User Sucessfully Deleted  '], 201);
        } else {
            return response()->json(['message' => 'User not found '], 201);
        }
    }


    public function change_pass(Validate_change_pass  $request)
    {
        $user = Auth()->user();
        // dd($user->password);


        if ($user) {
            $x = Hash::check($request->password, $user->password);

            if (!$x) {
                return response()->json(["error" => " password is wrong "], 400);
            } else if ($request->password == $request->new_pass) {
                return response()->json(["error" => " Old password =  new password  "], 400);
            } else {
                User::where('id', $user->id)->update(array('password' => hash::make($request->new_pass)));
                return response()->json(["success" => "Password Changed Successfully "], 200);
            }
        }
    }
}