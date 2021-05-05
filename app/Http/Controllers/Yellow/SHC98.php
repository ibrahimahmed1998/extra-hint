<?php
namespace App\Http\Controllers\Yellow;
use App\Http\Controllers\Controller;
use App\Http\Requests\SHC_;
use App\Models\Shc as model;
use Illuminate\Http\Request;

class SHC98 extends Controller
{
    public function __construct() {         $this->middleware('auth:api', ['except' => []]);    }
  
    public function shc98(SHC_ $request) // add COURSE to SCETION
    {
        $check = model::where('dep_id', $request->dep_id)->
        where('Sec_id', $request->Sec_id)->where('ccode', $request->ccode)->first();

        if ($check) {
            return response()->json(['err' => 'course added before !'], 201);
        } else {
            model::create(
                [
                    'dep_id' => $request->dep_id,
                    'Sec_id' => $request->Sec_id,
                    'ccode' => $request->ccode,
                    'c_theoretical_ratio' => $request->c_theoretical_ratio,
                    'c_elective' => $request->c_elective,
                    'c_semester' => $request->c_semester,
                    'c_lvl' => $request->c_lvl,

                ]
            );
            return response()->json(['message' => 'Section Has Course Rel Created Sucessfully '], 201);
        }
    }

    public function del_shc98(Request $request)
    {
        $request->validate([ 
            'ccode' => 'required|string|exists:Courses',     
            'sec_id' => 'required|integer|exists:Sections',
            'dep_id' => 'required|integer|exists:Departments']);
       
            model::where('ccode', $request->ccode)
            ->where('sec_id', $request->sec_id)
            ->where('dep_id', $request->dep_id)
            ->delete();
        return response()->json(['Sucessfully' => " Course deleted Sucessfully from Scetion"], 201);
    }
}
