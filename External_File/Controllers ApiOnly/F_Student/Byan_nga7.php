<?php

namespace App\Http\Controllers\F_Student;

use App\Http\Controllers\Auto\Auto_node\GPA;
use App\Http\Controllers\Auto\Refresh;
use App\Http\Controllers\Controller;
use App\Models\enroll;
use Illuminate\Http\Request;

class Byan_nga7 extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:api', ['except' => []]);
   }

   public function byan_nga7(Request $req)
   {
      $user = auth()->user();
      $id = $user->id;
      //$refresh = new Refresh();  $refresh->refresh_f(); //////////////////////////////

      $req->validate(['msg' => 'required|string']);

      if ($user->type != 1) {
         $req->validate(['Student_id' => 'integer|exists:Students']);
         $id = $req->Student_id;
      }

      $year = $req->year;
      $semester = $req->semester;
      $class = new GPA();
      
      if ($req->msg == 'sgpa') 
      {
         $req->validate(['year' => 'required|integer|min:2000', 'semester' => 'required|integer|between:1,3']);
         return  $class->gpa($id, 'sgpa', $year, $semester);
      } else if ($req->msg == 'cgpa') {
         return  $class->gpa($id, 'cgpa', 0, 0);
      }
   }

   public function Student_Records(Request $req)
   {
      $user = auth()->user();     $id = $user->id;       $class = new GPA();

      if ($user->type != 1)
      {
         $req->validate(['Student_id' => 'integer|exists:Students']);
         $id = $req->Student_id;
      }

     // $years = DB::select('SELECT DISTINCT year FROM enrolls WHERE student_id='.$id.';', [1]);
     $years = enroll::where('student_id',$id)->distinct()->pluck('year');
 

      $all_semester= [1,2,3];


      $years_array = [] ; 

      for ($i=0; $i < $years->count() ; $i++)   
       { // echo "1 ";
          $years_array[] = $years[$i]  ;  
       } 
      
      $arrz = [] ; 

      for ($i=0; $i <sizeof($years) ; $i++)
       { 
            for ($j=0; $j <sizeof($all_semester) ; $j++) 
           { 
             $arrz[] =  $class->gpa($id,'sgpa',$years_array[$i], $all_semester[$j] );
           }

       }

         $cgpa = $class->gpa($id, 'cgpa',0,0);

       
       array_push($arrz, $cgpa);

       return $arrz; 

      
   } 
}
