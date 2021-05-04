<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Signup_;
use App\Models\Department;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;

class Add_user extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' => ['add_user']]); }
   
    public function add_user(Signup_ $req)
    {
        //  $vcode = Str::random(70);
        $user = User::create([
            'id' => $req->id,
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'password' => $req->password,
            'email' => $req->email,
            'type' => $req->type,
            'phone' => $req->phone,
            'created_at'=>now()
        ]);

        if ($user->type == 1) 
        {
            $sec = Section::where('Sec_id', $req->sec_id)->first();
            $dep = Department::where('dep_id', $req->dep_id)->first();

            if (!$sec || !$dep)
             {
                User::find($req->id)->delete();
                return response()->json(['err' => 'section or department not found'], 201);
             } 
            else
             {
                Student::create(['Student_id' => $req->id, 'roadmap' => 1 , 'live_hour' => 12,
                                 'c_gpa' => 0, 'dep_id' => $req->dep_id, 'sec_id' => $req->sec_id  ]);   
                                
                return response()->json(['success' => 'Student joins...AMS'], 201);
             }
        }

        return response()->json(['success' => 'joins...AMS'], 201);

        /* Mail::to($user)->send(new verifyEmail($user->firstname, $vcode));

        return response()->json(['message' => 'Successfully sign up ,Look at your email inbox'], 201);
        */
    }

}