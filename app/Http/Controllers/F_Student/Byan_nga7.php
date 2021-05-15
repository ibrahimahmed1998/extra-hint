<?php
namespace App\Http\Controllers\F_Student;
use App\Http\Controllers\Auto\Auto_node\GPA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Byan_nga7 extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }

    public function byan_nga7(Request $req)
    {
        $user = auth()->user();
        $id = $user->id ; 

        $req->validate(['msg'=>'required|string']);

        if($user->type != 1 )
         { 
            $req->validate(['Student_id'=>'integer|exists:Students']);
            $id = $req->Student_id;
         }

        $year = $req->year;         $semester = $req->semester;     $class = new GPA();  

        if($req->msg=='sgpa')
         { 
            $req->validate(['year'=>'required|integer|min:2000','semester'=>'required|integer|between:1,3']);
            return  $class->gpa($id,'sgpa',$year,$semester);
         }
    
        else if($req->msg=='cgpa')
         { 
            return  $class->gpa($id,'cgpa',0,0);  
         }  
}}