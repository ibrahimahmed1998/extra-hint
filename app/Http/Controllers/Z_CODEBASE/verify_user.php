<?php

namespace App\Http\Controllers\AUTH_USERS;

use App\Http\Controllers\Controller;;

use App\Models\User;

class VerifyUser extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' => []]); }
  
    public function verifyUser($verification_code)
    {
        $check = User::where('vcode', $verification_code)->first();
        if (!is_null($check)) {
            if ($check->email_verified_at != null) {
                return response()->json(['err' => "User Has Verified Before"], 401);
            } else {
                User::where('id', $check->id)->update(['email_verified_at' => now()]);
                return view('verifyUser_view');
            }
        } else {
            return response()->json(['err' => "Verification code is invalid."], 401);
        }
    }

            /*  SIGN UO 
        //  $vcode = Str::random(70);

            Mail::to($user)->send(new verifyEmail($user->firstname, $vcode));

        return response()->json(['message' => 'Successfully sign up ,Look at your email inbox'], 201);
        */
}
