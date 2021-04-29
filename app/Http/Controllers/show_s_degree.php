<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\enroll;
use App\Models\Student;
use Illuminate\Http\Request;

class show_s_degree extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => []]);
  }

  public function show_s_degree(Request $request)
  {
    $request->validate([
      'Student_id' => 'integer|exists:Students',
      'year' => 'integer',
      'semester' => 'integer|between:1,3' ]);

    $user=auth()->user();

    if($request->Student_id && $user->type==1 )
    {
      return response()->json(['err'=>'this is for stuff only']);
    }

    if(!$request->Student_id)    // auth student
    {
      $user=Student::where('Student_id',$user->id)->first();
    }

    else // stuff
    {
      $user=Student::where('Student_id',$request->Student_id)->first();  
    }

    if(!$user)
    {
      return response()->json(['err'=>'not found in Student Table']);
    }

    $arr = [];

     if (!$request->all_years )
     {
      $state = "ALL_YEAR";
      $get = enroll::where('Student_id', $user->Student_id)->get();
     }

     elseif (!$request->all_years && $request->semester && $request->year)
      {
        $state = "SEM-YEAR";
        $get = enroll::where('year', $request->year)->where('semester', $request->semester)->
        where('Student_id', $user->Student_id)->get();
      } 

      else if ($request->all_years)  // REQ-ALL-YEARS
      {
        $state = "ALL_YEAR";
        $get = enroll::where('Student_id', $user->Student_id)->get();
      }

      for ($i = 0; $i < $get->count(); $i++) 
      {
        $arr[] = $get[$i];
      }

     return response()->json(['status' => $state, 'degree' => $arr]);
  }
}
