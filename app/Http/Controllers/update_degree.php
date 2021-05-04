<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validate_Enroll_degree;
use App\Models\Course;
use App\Models\enroll;

class update_degree extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>[ "auto_update_degree" ] ]);
    }

    
    public function auto_update_degree()
    {
        $get = enroll::all();
         
      for ($i=0; $i <$get->count(); $i++)
      {
        $course = Course::where('ccode', $get[$i]->ccode)->first();

        $classwork= ( $get[$i]->hmedterm_d + $get[$i]->hlab_d + $get[$i]->horal_d );
        $total = ($get[$i]->hclass_work_d + $get[$i]->hfinal_d);

        if( $total >=  ($course->dtotal)*0.60){  $is_pass = 1; }
        else { $is_pass = 0; }
        
  
          $update= enroll::where('ccode', $get[$i]->ccode)->where('year', $get[$i]->year)->
          where('semester', $get[$i]->semester)->where('Student_id', $get[$i]->Student_id);

          $update->update(array("hpass" =>$is_pass,"htotal_d"=>$total,"hclass_work_d"=>$classwork));    
      }
        
     // return response()->json(['success' => 'updated'], 201);
  }
      
    public function update_student_degree(Validate_Enroll_degree $request)
    {
        $check = enroll::where('ccode', $request->ccode)->where('year', $request->year)->
        where('semester', $request->semester)->where('Student_id', $request->Student_id)->first();

        $update = enroll::where('ccode', $request->ccode)->where('year', $request->year)->
        where('semester', $request->semester)->where('Student_id', $request->Student_id);

        $course = Course::where('ccode', $request->ccode)->first();

        if ($check) 
        {
            if 
              (
                $request->hmedterm_d > $course->dmidterm || $request->hmedterm_d<0 ||
                $request->hlab_d > $course->dlab  || $request->hlab_d<0 ||
                $request->horal_d > $course->doral || $request->horal_d<0 ||
                $request->hfinal_d > $course->dfinal  || $request->hfinal_d<0 
               
              ) 
              {
                return response()->json(['error' =>'Degrees > Course expected Degrees or < 0 '], 201);
              } 
            else 
              {
                $update->update(array(
                    'hmedterm_d' => $request->hmedterm_d,
                    'hlab_d' => $request->hlab_d,
                    'horal_d' =>  $request->horal_d,
                    'hfinal_d' => $request->hfinal_d,
                ));

              }

              $class = new update_degree() ; $class->auto_update_degree();

            return response()->json(['Success' => 'Degree has updated'], 201);
        }
         else 
        {
            return response()->json(['error' => 'Degree not updated , may doesn\'t enrolled '.
            $request->ccode.' at SEM:'.$request->semester.' YEAR:'.$request->year], 400);
        }
    }
}
