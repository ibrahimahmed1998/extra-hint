<?php
namespace App\Http\Controllers\Auto;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auto\Auto_node\Lvl;
use App\Http\Controllers\Auto\Auto_node\Live_hour;
use App\Http\Controllers\Auto\Auto_node\GPA;
use App\Models\Student;

class Auto_student extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' =>  ['auto_student']]); }
   
    public function auto_student()   // $id
    {
        $id = 200 ;
        $student = Student::where('Student_id',$id);
       
        $lvl = new Lvl();         $GPA = new GPA();         $hours = new Live_hour();

        $student->update(array('live_hour'=>$hours->live_hour($id),
                                'c_gpa'=>$GPA->gpa($id,'msg',0,0),
                                'lvl'=>$lvl->lvl($id)
                            )); 
    } 
}