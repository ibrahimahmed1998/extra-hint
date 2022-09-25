<?php
namespace App\Http\Controllers\Yellow;
use App\Http\Controllers\Controller;
use App\Models\Shc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class List_C extends Controller{ // CRUD

    public function __construct() {   $this->middleware('auth:api', ['except' => ['read']]);}
    public function read(Request $req){

        $req->validate([
            'dep_id' => 'required|integer|exists:Departments',
            'sec_id' => 'integer|exists:Sections',
            'c_lvl' => 'integer|between:1,4|',
            'c_semester' =>'integer|between:1,3',
        ]);

        $arr=[];

        if ($req->dep_id && !$req->sec_id ){  $c = Shc::where("dep_id", $req->dep_id)->orderBy('c_lvl')->get();  }

        if ($req->dep_id && $req->sec_id){
            $c = Shc::where("dep_id", $req->dep_id)->where("Sec_id", $req->sec_id)->orderBy('c_lvl')->get(); }

        if ($req->dep_id && $req->sec_id && $req->c_lvl)  {
            $c = Shc::where("dep_id", $req->dep_id)->
                      where("Sec_id", $req->sec_id)->
                      where("c_lvl", $req->c_lvl)->orderBy('c_lvl')->get(); }

        if ($req->dep_id && $req->sec_id && $req->c_lvl && $req->c_semester)  {
            $c = Shc::where("dep_id", $req->dep_id)->
                      where("Sec_id", $req->sec_id)->
                      where("c_lvl", $req->c_lvl)->
                      where('c_semester', $req->c_semester)->orderBy('c_lvl')->get();  }

        foreach ($c as $cc)  {  $arr[]=$cc;  }

        return View::make("Department/get_course", compact('arr'));
        //return response()->json($arr );
}}
