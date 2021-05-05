<?php
namespace App\Http\Controllers\F_Advisor;

use App\Http\Controllers\AUTO\Auto_degree;
use App\Http\Controllers\Controller;
use App\Http\Requests\Enter_degree_;
use App\Models\Course;
use App\Models\enroll;

class Enter_degree extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => [] ]); }

    public function enter_degree(Enter_degree_ $req)
    {
        $ec = enroll::where('ccode', $req->ccode)->where('year', $req->year)-> /*////// ec = Enrolled Course //////*/
        where('semester', $req->semester)->where('Student_id', $req->Student_id);

        $ie =  $ec->first();  /*////// ie = IS Enrolled ???? //////*/

        $course = Course::where('ccode', $req->ccode)->first();

        if ($ie) 
        {
            if 
              (
                $req->hmedterm_d > $course->dmidterm || $req->hmedterm_d<0 ||
                $req->hlab_d > $course->dlab  || $req->hlab_d<0 ||
                $req->horal_d > $course->doral || $req->horal_d<0 ||
                $req->hfinal_d > $course->dfinal  || $req->hfinal_d<0 
               
              ) 
              {
                return response()->json(['err' =>'Degrees > Course expected Degrees or < 0 '], 201);
              } 
            else 
              {
                $ec->update(array(
                    'hmedterm_d' => $req->hmedterm_d,
                    'hlab_d' => $req->hlab_d,
                    'horal_d' =>  $req->horal_d,
                    'hfinal_d' => $req->hfinal_d,
                ));
              }

              $class = new Auto_degree() ; $class->auto_degree();

            return response()->json(['Success' => 'Degrees updated'], 201);
        }
         else 
        {
            return response()->json(['err' => 'Degree not updated ! , may doesn\'t enrolled '.
            $req->ccode.' at SEM:'.$req->semester.' YEAR:'.$req->year], 400);
        }
    }
}
