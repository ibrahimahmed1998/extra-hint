<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\Validate_delete;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\auth\Validate_signup;
use App\Http\Requests\student_area\Validate_SCT;
use App\Models\Sct;

class Admin extends Controller   
{
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  [ ] ]);     
    }

    public function search(Request $request) // by name 
    {
       // dd(auth()->user()->type); 
        $user = User::where('full_name', $request->name)->get();
        return response()->json(['message' =>  $user], 201);
    }

    public function list_all() // list all users 
    {
        $user = User::all();
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

    public function cancel_course(Validate_SCT $request)
    {
        /* permison */
        $check = Sct::where('ccode', $request->ccode)->where('year', $request->year)->where('semester', $request->semester)->where('Student_id', $request->Student_id)->first();

        if ($check) {
            $check = Sct::where('ccode', $request->ccode)->where('year', $request->year)->where('semester', $request->semester)->where('Student_id', $request->Student_id)->delete();
            return response()->json(['Sucessfully' => " Course Canceled Sucessfully"], 201);
        } else {
            return response()->json(['error' => "Course Not Found "], 400);
        }
    }
    
}
