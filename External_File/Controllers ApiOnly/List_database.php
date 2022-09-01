<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Attend;
use App\Models\Course;
use App\Models\Department;
use App\Models\Pre_request;
use App\Models\Section;
use App\Models\Session;
use App\Models\Shc;
use App\Models\Student;
use App\Models\User;

class List_database extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function list_database(Request $req)
    {
        $req->validate(['value'=>'required|integer']);

        switch ($req->value) 
        {

            case '1':  return User::all();  break;
              
            case '2': return Student::all();  break;

            case '3':  return Course::all();  break;

            case '4': return Shc::all();  break;

            case '5': return  Section::all();    break;

            case '6': return Pre_request::all(); break;

            case '7': return Department::all(); break;

            case '8': return Attend::all(); break;

            case '9':  return Session::all(); break;

            default:
            {return response()->json(['err' =>"Have not premission"], 400); }
        }
    }
}
