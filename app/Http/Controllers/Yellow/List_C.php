<?php
namespace App\Http\Controllers\Yellow;
use App\Http\Controllers\Controller;
use App\Models\Shc;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use PDO;

class List_C extends Controller{

    public function __construct() {   $this->middleware('auth:api', ['except' => ['read']]);}

    public function read(Request $req){

        $student = Student::where('user_id',$req->user_id)->get()->first();
        $user=User::where('id',$req->user_id)->get();

        // dd($user);
         if($student) {
    
            $req->dep_id = $student->Dep_id;
            $req->sec_id = $student->Sec_id;
            $req->c_lvl =  $student->lvl;

          }else{
            $req->validate([
                'dep_id' => 'required|integer|exists:Departments',
                'sec_id' => 'integer|exists:Sections',
                'c_lvl' => 'integer|between:1,4|',
                'c_semester' =>'integer|between:1,3',
            ]);
         } 
         
        $arr=[];

        if($req->dep_id && !$req->sec_id ){ 
            $c = Shc::where("dep_id", $req->dep_id)->orderBy('c_lvl')->get();

        }

        if($req->dep_id && $req->sec_id)
         { $c = Shc::where("dep_id", $req->dep_id)->where("Sec_id", $req->sec_id)->orderBy('c_lvl')->get();}

        if ($req->dep_id && $req->sec_id && $req->c_lvl) 
          {
            $c = Shc::where("dep_id", 1)->
                      where("Sec_id", 0)->
                      where("c_lvl", 1)->orderBy('c_lvl')->get();
                    
                    // here edit
          
            }

        if ($req->dep_id && $req->sec_id && $req->c_lvl && $req->c_semester)  {
            $c = Shc::where("dep_id", $req->dep_id)->
                      where("Sec_id", $req->sec_id)->
                      where("c_lvl", $req->c_lvl)->
                      where('c_semester', $req->c_semester)->orderBy('c_lvl')->get()->first();  }

        foreach ($c as $cc)  {  $arr[]=$cc;  }

            // dd($arr);
      
        if($student)
        {
            return View::make("Serivce/user_data", 
            [
            'user' => $user->first(),
            'student'=>$student,
            'adv_name'=>"",
            'dname'=>"",
            'sname'=>" ",
            'courses'=>$arr
        ]);
        }
        
        return View::make("Department/get_course", compact('arr'));
        //return response()->json($arr );
}}
