<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\Validate_delete;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\auth\Validate_signup;

class Admin extends Controller  /// for adminstratooooooooooor
{
    /*if (auth()->type == 3) 
        {}
        else { return response()->json(['error' => ' You are not adminstrator '], 400 ); }
    */
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>
        [
            'search'
        ]]);
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

    public function search(Request $request)
    {
        $user = User::where('full_name', $request->name)->get();
        return response()->json(['message' =>  $user], 201);
    }

    public function delete_user(Validate_delete  $request)
    {
        if (User::find($request->id)) {
            User::find($request->id)->delete();
            return response()->json(['message' => 'User Sucessfully Deleted  '], 201);
        } else {
            return response()->json(['message' => 'User not found '], 201);
        }
    }
}
