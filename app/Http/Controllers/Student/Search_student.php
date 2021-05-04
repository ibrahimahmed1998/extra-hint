<?php
namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class Search_student extends Controller
{
    public function __construct()  {  $this->middleware('auth:api', ['except' =>[]]); }

    public function search_student(Request $req)
    {
        $s=0;
        $arr=[];
        $req->validate(['all' => 'numeric|min:1|not_in:0']);

         if ($req->dep_id && $req->sec_id ) 
         {
            $req->validate(['dep_id' => 'integer|exists:Departments','sec_id' => 'integer|exists:Sections']);
            $s = Student::where('dep_id', $req->dep_id)->where('sec_id', $req->sec_id)->get();
         } 

        else if ($req->Student_id) 
        {
            $req->validate(['Student_id' => 'integer|exists:Students']);
            $s = Student::where('Student_id', $req->Student_id)->get();
        }

        else if ($req->lvl)
         {
            $req->validate(['lvl' => 'integer|between:1,4']);
            $s = Student::where('lvl', $req->lvl)->get();

         }

        else if ($req->adv_id) 
         {
            $req->validate(['adv_id' => 'integer|exists:Users,id']);
            $advisor=User::where('id',$req->adv_id)->first();
            if($advisor->type!=2){ return response()->json(['err'=>"this not adv id"]);}
            $s = Student::where('adv_id', $req->adv_id)->get();

         } 

        else if ($req->first_name && $req->last_name) 
         {
            $req->validate(['last_name' => 'string|exists:Users', 'first_name' => 'string|exists:Users']);
            $user = User::where('first_name', $req->first_name)->where('last_name', $req->last_name)
                        ->where('type',1)->get();
            
            for ($i = 0; $i < $user->count(); $i++) 
            {
                    $s = Student::where('Student_id', $user[$i]->id)->get();
                    $arr[]=  ["record"=>$s,"Student Name"=>$user[$i]->first_name] ;   
            }
        
            return $arr;
         }

        else if ($req->all) 
        {
            $s = Student::all();
        }
        
        if(!$s) { return response()->json(['err'=>"enter choice"]); }
        return response()->json(['success' =>  $s], 201); 
    }
}