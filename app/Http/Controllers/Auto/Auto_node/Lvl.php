<?php
namespace App\Http\Controllers\Auto\Auto_node;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\enroll;
use App\Models\Student;

class Lvl extends Controller
{
    public function __construct() {   $this->middleware('auth:api', ['except' => []]); }
  
    public function lvl($id)
    {
        $s=Student::where('Student_id',$id)->first();
        if(!$s){ return response()->json(['err'=>'student not found'], 400); }
        $passed_courses = enroll::where('hpass', 1)->where('Student_id', $id)->get();

        $sum = 0;
        
        foreach ($passed_courses as $p) { $sum = $sum + Course::where('ccode', $p->ccode)->value('cch'); }
      
        $lvl = 1;

        if ($sum >= 0 && $sum < 33) {  $lvl = 1; } 
        else if ($sum  >= 33 && $sum < 67) { $lvl = 2; }
        else if ($sum  >= 67 && $sum < 100) { $lvl =  3; }
        else if ($sum  >= 100 && $sum < 134) {$lvl =  4;}
        else if ($sum >= 134) { response()->json(['success' => 'graduated'], 201);   }
        else { return response()->json(['err' => 'level calculator has error  '], 400); }

       return $lvl ;
    }
}