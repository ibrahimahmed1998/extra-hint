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
        $req->validate(['Student_id'=>'required|integer|exists:Students',
                        'year'=>'integer|min:2000',
                        'semester'=>'integer|between:1,3',
                        'msg'=>'required|string'
            ]);

        $id = $req->Student_id;
        $year = $req->year;
        $semester = $req->semester;
        
        $class = new GPA();

        $user=autH()->user();   if($user->type==1) {  $id=$user->id; }    
        
        if($req->msg=='sgpa') {   return  $class->gpa($id,'sgpa',$year,$semester); }
    
        else if($req->msg=='cgpa') {  return  $class->gpa($id,'cgpa',$year,$semester); }  
    }
}