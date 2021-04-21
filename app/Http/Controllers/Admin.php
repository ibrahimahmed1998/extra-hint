<?php
namespace App\Http\Controllers;
use App\Http\Requests\auth\validate_delete;
use App\Models\User;
use Illuminate\Http\Request;

class Admin extends Controller   
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  [ ] ]);     
    }

    public function search(Request $request) // by name 
    {
        $user = User::where('full_name', $request->name)->get();
        return response()->json(['success' =>  $user], 201);
    }

    public function list_all() // list all users 
    {
        $user = User::all();
        return response()->json(['success' =>  $user], 201);
    }

    public function delete_user(validate_delete  $request)
    {
        if (User::find($request->id)) 
        {
            User::find($request->id)->delete();
            return response()->json(['success' => 'User  Deleted  '], 201);
        } else 
        {
            return response()->json(['error' => 'User not found '], 201);
        }
    }

}
