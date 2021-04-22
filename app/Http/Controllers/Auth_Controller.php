<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\validate_delete;
use App\Http\Requests\auth\Validate_Login;
use App\Http\Requests\auth\Validate_signup;
use App\Models\Student;
use App\Models\User;

class Auth_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup',]]);
    }

    public function signup(Validate_signup  $request)
    {
        //  $vcode = Str::random(70);
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
        //add_student_  
        if ($user->type == 1) 
        {
            $request->validate(
                [
                    'adv_id' => 'required|integer|exists:Users,id|different:Student_id',
                    'dep_id' => 'required|integer|exists:Departments,dep_id',
                    'sec_id' => 'required|integer|exists:Sections,sec_id',
                ]
            );

            $advisor_counter = Student::where('adv_id', $request->adv_id)->get()->count();

            if ($advisor_counter >= 10)
             {
                return response()->json(['error' => "please attach with another , advisor who's id =  " . $request->adv_id . " is completed"], 401);
            } else 
            {
                Student::create(
                    [
                        'Student_id' => $request->id,
                        'roadmap' => 1, // must be null first 
                        'live_hour' =>12,
                        'c_gpa' =>0,
                        'lvl' =>1,
                        'adv_id' => $request->adv_id,
                        'dep_id' => $request->dep_id,
                        'sec_id' => $request->sec_id,
                    ]
                );
                return response()->json(['message' => 'Student Created Sucessfully '], 201);
            }
        }

        return response()->json(['Success' => 'added to AMS'], 201);

        /* Mail::to($user)->send(new verifyEmail($user->firstname, $vcode));

        return response()->json(['message' => 'Successfully sign up ,Look at your email inbox'], 201);
        */
    }

    public function login(Validate_Login $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = auth()->attempt($credentials)) {

            $token =    $this->respondWithToken($token);
            $user = auth()->user();;
            return response()->json(['token' => $token, 'user type' => $user->type]);
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

    public function delete_user(validate_delete  $request)
    {
        if (User::find($request->id)) {
            User::find($request->id)->delete();
            return response()->json(['success' => 'User  Deleted  '], 201);
        } else {
            return response()->json(['error' => 'User not found '], 201);
        }
    }

    public function list_all() // list all users 
    {
        $user = User::all();
        return response()->json(['success' =>  $user], 201);
    }

    /*
    public function search(Request $request) // by name 
    {
        $user = User::where('full_name', $request->name)->get();
        return response()->json(['success' =>  $user], 201);
    }
    */
}
