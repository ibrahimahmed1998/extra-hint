<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\update_user_;
use App\Http\Requests\Validate_signup; 
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup',]]);
    }

    public function signup(Validate_signup  $request)
    {
        //  $vcode = Str::random(70);
        $user = User::create([
            'id' => $request->id,
            'full_name' => $request->full_name,
            'password' => $request->password,
            'email' => $request->email,
            'type' => $request->type,
            'phone' => $request->phone,
        ]);
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
                        'roadmap' => 1,  
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

    public function login(Request $request)
    {
        $request->validate( ['email'=>'required|email:rfc,dns','password'=>'required|min:8']);
           
        $credentials = $request->only('email', 'password');

        if ($token = auth()->attempt($credentials)) 
         {    
            return response()->json(['token'=>$this->respondWithToken($token),'type'=>auth()->user()->type]);
         } 
        else
         {
            return response()->json(['error' => "Wrong credintials, Please try to login with a valid e-mail or password"], 401);
         }
    }

    public function me()        //  Get the authenticated User. 
    {
        return response()->json(auth()->user());
    }

    public function refresh()   
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)          
    {
        return response()->json(['token'=>$token,'expires_in'=>auth()->factory()->getTTL()*60 
        /*'token_type' => 'bearer',*/]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['success'=>'logged out']);
    }

    public function delete_user(Request  $request) // note this automatic delete user if it student too 
    {
        $request->validate(['id' => 'required|integer|exists:Users' ]);    

            User::find($request->id)->delete();
            return response()->json(['success' => 'User  Deleted  '], 201);
    }

    public function list_all()  
    {
        return response()->json(['success' =>  User::all()], 201);
    }

    public function update_user(update_user_ $request)
    {
        $user = User::find($request->id);

        $must1 = User::where('email', $request->email)->first();
        $must2 = User::where('phone', $request->phone)->first();

        if ($user->id == $must1->id && $user->id == $must2->id) 
        {
            $user->update([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
            ]);
            return response()->json(['updated' => $user], 201);
        }
        else
        {
            return response()->json(['err' =>'other users use same phone or email'], 201);
        }
    }

    /*
    public function search(Request $request) // by name 
    {
        $user = User::where('full_name', $request->name)->get();
        return response()->json(['success' =>  $user], 201);
    }
    */
}
