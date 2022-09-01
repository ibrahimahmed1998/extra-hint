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
   
    public function auto_student()   /**************** AUTOMATIC ***************** */  
    {
        $s = Student::all();

        $auto = new Auto_degree() ; $auto->auto_degree();  

        $lvl = new Lvl();         $GPA = new GPA();         $hours = new Live_hour();

        for ($i=0; $i <$s->count() ; $i++)
         { 

            $student = Student::where('Student_id',$s[$i]->Student_id );

            $student->update(array(
            
            'live_hour'=>$hours->live_hour($s[$i]->Student_id),

            'c_gpa'=>$GPA->gpa($s[$i]->Student_id,'msg',0,0),

            'lvl'=>$lvl->lvl($s[$i]->Student_id) )); 

         } 
}}