<?php
namespace App\Http\Controllers\Yellow;
use App\Http\Controllers\Controller;
use App\Models\Shc;
use Illuminate\Http\Request;

class List_C extends Controller
{
    public function __construct() {   $this->middleware('auth:api', ['except' => ['list_c']]);}
  
    public function list_c(Request $req)  
    {
        $req->validate([
            'dep_id' => 'required|integer|exists:Departments',
            'sec_id' => 'integer|exists:Sections',
            'c_lvl' => 'integer|between:1,4|',
            'c_semester' =>'integer|between:1,3',
        ]);

        $arr=[];

        if ($req->dep_id) 
        {
            $c = Shc:: where("dep_id", $req->dep_id)->get();
        }

        if ($req->dep_id && $req->sec_id)
         {
            $c = Shc::where("dep_id", $req->dep_id)->
                      where("Sec_id", $req->sec_id)->get();
        }

        if ($req->dep_id && $req->sec_id && $req->c_lvl)
         {
            $c = Shc::where("dep_id", $req->dep_id)->
                      where("Sec_id", $req->sec_id)->
                      where("c_lvl", $req->c_lvl)->get();
        }

        if ($req->dep_id && $req->sec_id && $req->c_lvl && $req->c_semester)
         {
            $c = Shc::where("dep_id", $req->dep_id)->
                      where("Sec_id", $req->sec_id)->
                      where("c_lvl", $req->c_lvl)->
                      where('c_semester', $req->c_semester)->get();            
         }

        foreach ($c as $cc)  {  $arr[]=$cc ;    }
        return response()->json(['success' => $arr ], 201);}}