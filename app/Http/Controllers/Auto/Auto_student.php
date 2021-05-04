<?php
namespace App\Http\Controllers\Auto;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auto\Auto_node\Lvl;
use App\Http\Controllers\Auto\Auto_node\Live_hour;
use App\Http\Controllers\Auto\Auto_node\CGPA;
use App\Models\Student;

class Auto_student extends Controller
{
    public function __construct() {  $this->middleware('auth:api', ['except' =>  []]); }
   
    public function auto_student($id)  
    {
        $student = Student::where('Student_id',$id);
       
        $lvl = new Lvl();         $CGPA = new CGPA();         $hours = new Live_hour();

        $student->update(array('live_hour'=>$hours->live_hour($id),
                                'c_gpa'=>$CGPA->cgpa($id),
                                'lvl'=>$lvl->lvl($id)
                            ));
    } 
}