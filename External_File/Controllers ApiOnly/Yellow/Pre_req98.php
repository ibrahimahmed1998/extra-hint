<?php
namespace App\Http\Controllers\Yellow;
use App\Http\Controllers\Controller;
use App\Models\Pre_request;
use Illuminate\Http\Request;

class Pre_req98 extends Controller
{
    public function __construct() {         $this->middleware('auth:api', ['except' => []]);    }
  
    public function pre_req98(Request $request) //create 
    {
        $request->validate([
            'ccode' => 'required|string|exists:Courses',
            'pr_ccode' => 'required|string|different:ccode|exists:Courses,ccode'
        ]);
       
        $check = Pre_request::where('ccode', $request->ccode)->where('pr_ccode', $request->pr_ccode)->first();
     
        if ($check)
         {
            return response()->json(['err' => "Course added Before"], 401);
        } else 
        {

            Pre_request::create( ['ccode' => $request->ccode, 'pr_ccode' => $request->pr_ccode]);
            

            return response()->json(['success' => 'Pre_request Course Created'], 201);
        }
    }

    public function del_pr98(Request $request) //create 
    {
        $request->validate([ 
            'ccode' => 'required|string|exists:Courses,ccode',      
            'pr_ccode' => 'required|string|different:ccode|exists:Pre_requests']);
       
        $pr=Pre_request::where('ccode', $request->ccode)->where('pr_ccode', $request->pr_ccode);
        
        if(!$pr->first()) {  return response()->json(['err' => "Prerequest Course not found"], 201);  }

        $pr->delete();
        return response()->json(['success' => "Prerequest Course deleted"], 201);
    }

}