<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validate_change_pass;
use App\Http\Requests\Validate_delete;
use App\Http\Requests\Validate_Login;
use App\Http\Requests\Validate_signup;
use App\Http\Requests\Validate_Student;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct( )
    {
     $this->middleware('auth:api', ['except' => ['login', 'signup','Student','delete_user'] ]);
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
 
        if ( $token = auth()->attempt($credentials)) {
            {
                $this->respondWithToken($token) ;   
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

    public function Student(Validate_Student  $request)
    {

        $check = Student::where('Student_id',$request->Student_id)->first();
        $advisor_counter = Student::where('adv_id',$request->adv_id)->get()->count();
        $is_adv = User::where('id',$request->adv_id)->value('type');
        $is_stu = User::where('id',$request->Student_id)->value('type');

        //dd($is_stu->type);
        if ( $is_stu != 1 )
        {
            return response()->json(['error' => "this id is not student , please use real student id "], 400);
        }

        if ( $is_adv != 2 )
        {
            return response()->json(['error' => "this id is not advisor , please use real advisor id "], 400);
        }

        if( $check )
        {
            return response()->json(['error' => "Student is found in system "], 400);
        }

        else 
        {
            if($advisor_counter >= 10 )
            {
                return response()->json(['error' => "please attach with another , advisor who's id =  ".$request->adv_id." is completed"], 401);
            }

            else
            {
                $Student = Student::create(
                    [
                        'Student_id' => $request->Student_id,
                        'roadmap' => $request->roadmap,
                        'live_hour' => $request->live_hour,
                        'total_gpa' => $request->total_gpa,
                        'current_lvl' => $request->current_lvl,
                        'adv_id' => $request->adv_id,
                        'dep_id' => $request->dep_id, 
                        'sec_id' => $request->sec_id,    
                    ]
                );
                return response()->json(['message' => 'Student Created Sucessfully '], 201);
            }}
    }

    public function delete_user(Validate_delete  $request)
    {
        /*if (auth()->type == 3) 
        {}
        else { return response()->json(['error' => ' You are not adminstrator '], 400 ); }
        */

        if( User::find( $request->id) )
        {
            User::find( $request->id)->delete();
            return response()->json(['message' => 'User Sucessfully Deleted  '], 201);

        }
        else
        {
            return response()->json(['message' => 'User not found '], 201);
        }
    }


    public function change_pass(Validate_change_pass  $request)
    {
        $user = Auth()->user();
       // dd($user->password);

     
        if ($user)
         {
           $x = Hash::check($request->password, $user->password );
            
            if ( ! $x  )
            {
                return response()->json(["error" => " password is wrong "], 400);
            } 
            else if ($request->password == $request->new_pass) 
            {
                return response()->json(["error" => " Old password =  new password  "], 400);
            } else {
                User::where('id', $user->id)->update(array('password' => hash::make($request->new_pass)));
                return response()->json(["success" => "Password Changed Successfully "], 200);
            }
        }
    }
}