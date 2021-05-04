<?php
namespace App\Http\Controllers\Enroll_Course;

use App\Http\Controllers\AUTO\Auto_degree;
use App\Http\Controllers\Controller;
use App\Models\enroll;
use App\Models\Student;
use Illuminate\Http\Request;

class Show_degree extends Controller
{
  public function __construct() { $this->middleware('auth:api', ['except' => []]);   }
 
  public function show_degree(Request $req)
  {
    

    $req->validate([
      'Student_id' => 'integer|exists:Students',
      'year' => 'integer',
      'semester' => 'integer|between:1,3' ]);

    $class = new Auto_degree() ; $class->auto_degree();

    $user=auth()->user();

    if($req->Student_id && $user->type==1 ) {return response()->json(['err'=>'this is for stuff only']);  }

    if(!$req->Student_id)    // auth student
    {
      $user=Student::where('Student_id',$user->id)->first();
    }

    else // stuff
    {
      $user=Student::where('Student_id',$req->Student_id)->first();  
    }

    if(!$user)
    {
      return response()->json(['err'=>'not found in Student Table']);
    }

    $arr = [];

     if (!$req->all_years )
     {
      $state = "ALL_YEAR";
      $get = enroll::where('Student_id', $user->Student_id)->get();
     }

     elseif (!$req->all_years && $req->semester && $req->year)
      {
        $state = "SEM-YEAR";
        $get = enroll::where('year', $req->year)->where('semester', $req->semester)->
        where('Student_id', $user->Student_id)->get();
      } 

      else if ($req->all_years)  // REQ-ALL-YEARS
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
