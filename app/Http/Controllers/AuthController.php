<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\update_user_;
use App\Http\Requests\Validate_signup;
use App\Models\Department;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup','test']]);
    }

    public function test( ) // by name 
    {
        print("hello world");
    }
    public function signup(Validate_signup  $request)
    {
        //  $vcode = Str::random(70);
        $user = User::create([
            'id' => $request->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => $request->password,
            'email' => $request->email,
            'type' => $request->type,
            'phone' => $request->phone,
            'created_at'=>now()
        ]);

        if ($user->type == 1) {
            $sec = Section::where('Sec_id', $request->sec_id)->first();
            $dep = Department::where('dep_id', $request->dep_id)->first();

            if (!$sec || !$dep) {
                User::find($request->id)->delete();
                return response()->json(['err' => 'section or department not found'], 201);
            } else {
                Student::create(
                    [
                        'Student_id' => $request->id,
                        'roadmap' => 1,
                        'live_hour' => 12,
                        'c_gpa' => 0,
                        'lvl' => 1,
                        'adv_id' => $request->adv_id,
                        'dep_id' => $request->dep_id,
                        'sec_id' => $request->sec_id,
                    ]
                );
                return response()->json(['success' => 'Student joins...AMS'], 201);
            }
        }

        return response()->json(['success' => 'joins...AMS'], 201);

        /* Mail::to($user)->send(new verifyEmail($user->firstname, $vcode));

        return response()->json(['message' => 'Successfully sign up ,Look at your email inbox'], 201);
        */
    }

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email:rfc,dns', 'password' => 'required|min:8']);

        $credentials = $request->only('email', 'password');
        
      if ($token = auth()->attempt($credentials)) 
        {
            $this->respondWithToken($token);
            return response()->json(["token"=>$token ,"name"=>auth()->user()->first_name , 'type' => auth()->user()->type] );
        } else {
            return response()->json(['err' => "Wrong credintials, Please try to login with a valid e-mail or password"], 401);
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
        return response()->json(['token' => $token, 'expires_in' => auth()->factory()->getTTL() * 60  ]);
    }

    public function logout()
    {
        auth()->logout();       return response()->json(['success' => 'logged out']);
    }

    public function delete_user(Request  $request) // note this automatic delete user if it student too 
    {
        $request->validate(['id' => 'required|integer|exists:Users']);

        User::find($request->id)->delete();
        return response()->json(['success' => 'User  Deleted  '], 201);
    }

    public function update_user(update_user_ $request)
    {
        $user = User::where('id', $request->id)->first();
        $all = User::get();
        $l = $user->count();

        for ($i = 0; $i < $l; $i++)
        {
         if ($request->email == $all[$i]->email && $user->id !=  $all[$i]->id) 
         {
            return response()->json(['err' => $request->email . " attached with " . $all[$i]->first_name." ".$all[$i]->last_name], 401);
         }
         else if ($request->phone == $all[$i]->phone && $user->id !=  $all[$i]->id) 
         {
            return response()->json(['err' => $request->phone . " attached with " . $all[$i]->first_name." ".$all[$i]->last_name], 401);
         }
        }
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
        ]);

        return response()->json(['updated' => $user], 201);
    }

    
    public function search(Request $request) // by name 
    {
        $request->validate(['all' => 'numeric|min:1|not_in:0']);
        $user=0;

        if ($request->first_name) {
            $request->validate(['first_name' => 'string|exists:Users']);
            $user = User::where('first_name', $request->first_name)->get();

        } else if ( $request->first_name  && $request->last_name ) 
        {
            $request->validate(['last_name' => 'string|exists:Users','first_name' => 'string|exists:Users']);
            $user = User::where('first_name', $request->first_name)->where('last_name', $request->last_name)->get();

        } else if ($request->id) {
            $request->validate(['id' => 'integer|exists:Users']);
            $user = User::where('id', $request->id)->get();

        } else if ($request->email) {
            $request->validate(['email' => 'email:rfc,dns|exists:Users']);
            $user = User::where('email', $request->email)->get();

        } else if ($request->phone) {
            $request->validate(['email' => 'email:rfc,dns|exists:Users']);
            $user = User::where('phone', $request->phone)->get();

        }
         else if ($request->all) 
        {
            $user = User::all();
        }

        if(!$user){ return response()->json(['err'=>"enter choice"]);}
        return response()->json(['success' =>  $user], 201);
    }
    
}
