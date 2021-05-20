<?php
namespace App\Http\Controllers\F_Advisor;

use App\Http\Controllers\Auto\Auto_degree;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\Get_time;
use App\Http\Requests\Enter_degree_;
use App\Models\Course;
use App\Models\enroll;

class Enter_degree extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => [] ]); }

    public function enter_degree(Enter_degree_ $req)
    {
      $gt=new Get_time();  $time=$gt->get_time();  $sem=$time['sem'];   $year=$time['year'];


        $ec = enroll::where('ccode', $req->ccode)->where('year', $year)-> /*////// ec = Enrolled Course //////*/
        where('semester', $sem)->where('Student_id', $req->Student_id);

        
        $ie =  $ec->first();  /*////// ie = IS Enrolled ???? //////*/

        $course = Course::where('ccode', $req->ccode)->first();

        if ($ie) 
        {
          if($req->hmedterm_d)
          {
            $req->validate(['hmedterm_d'=>"integer"]);

            if( $req->hmedterm_d > $course->dmidterm || $req->hmedterm_d < 0 )
            {
              return response()->json(['err' =>'MEDTERM > Course Degrees or < 0 '], 201);
            }
            $ec->update(array('hmedterm_d' => $req->hmedterm_d));
          }

           if($req->hlab_d)
          {
            $req->validate(['hlab_d'=>"integer"]);

            if( $req->hlab_d > $course->dlab  || $req->hlab_d<0 )
           
            {
              return response()->json(['err' =>'LAB > Course Degrees or < 0 '], 201);
            }

            $ec->update(array('hlab_d' => $req->hlab_d));
          }

           if($req->horal_d)
          {
            $req->validate(['horal_d'=>"integer"]);

            if( $req->horal_d > $course->doral || $req->horal_d<0 )
           
            {
              return response()->json(['err' =>' ORAL > Course Degrees or < 0 '], 201);
            }

            $ec->update(array('horal_d' => $req->horal_d));
          }
          
          if($req->hfinal_d)
          {
            $req->validate(['hfinal_d'=>"integer"]);

            if($req->hfinal_d > $course->dfinal  || $req->hfinal_d<0   )
            {
              return response()->json(['err' =>'Finals > Course Degrees or < 0 '], 201);
            }
            $ec->update(array('hfinal_d' => $req->hfinal_d));

          }
    
         $class = new Auto_degree() ; $class->auto_degree();
          return response()->json(['Success' =>$ec->first()], 201);
        }
         else 
        {
            return response()->json(['err' => 'Degree not updated ! , may doesn\'t enrolled '.
            $req->ccode.' at SEM:'.$sem.' YEAR:'.$year], 400);
        }}}