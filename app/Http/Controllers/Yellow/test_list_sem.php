<?php
namespace App\Http\Controllers\Yellow;
use App\Http\Controllers\Controller;
use App\Models\Shc;
use Illuminate\Http\Request;

class test_list_sem extends Controller
{
    public function __construct() {         $this->middleware('auth:api', ['except' => []]);    }
  
    public function list_c_sem(Request $request) // LIST COURSES - WHERE( LVL && SEMESTER && DEPARTMENT && SECITON )
    {
        $request->validate([
            'c_semester'=>'between:1,3|integer|required',
            'c_lvl'=>'required|between:1,4|integer',
            'sec_id' => 'required|integer|exists:Sections',
            'dep_id' => 'required|integer|exists:Departments']);

        $c = Shc::where('c_semester',$request->c_semester)->
                  where("c_lvl",$request->c_lvl)->
                  where("Sec_id",$request->Sec_id)->
                  where("dep_id",$request->dep_id)->get();

            foreach ($c as $cc ) 
            {
              print($cc);
            }
        return response()->json(['all list_courses' =>  $c], 201);
    }

}
