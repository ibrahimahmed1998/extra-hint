<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\update_student_;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }

    public function update_student(update_student_ $request)
    {
        $student = Student::where('Student_id', $request->Student_id);
        
        $lvl = new lvl_calc();
        $C_GPA = new GPA();
        $hours = new live_hour(); 
        $advisor = User::where('id',$request->adv_id)->first();
        if($advisor->type!=2)
        {
         return response()->json(['err' =>"not advisor id"], 401);
        }
        $counter = Student::where('adv_id', $request->adv_id)->get()->count();

        if ($counter >= 10) 
        {
            return response()->json(['err' => "can't follow this advisor he has ".$counter." Students"], 401);
        } else 
        {
            if ($student)
             {
                $student->update(array(
                    'live_hour' =>$hours->live_hourf($request),
                    'c_gpa' =>$C_GPA->gpa_calc($request),
                    'lvl' => $lvl->lvl_calc_f($request),
                    'roadmap' => $request->roadmap,
                    'adv_id' => $request->adv_id,
                    'dep_id' => $request->dep_id,
                    'sec_id' => $request->sec_id
                ));
                return response()->json(['Success' => 'Student Updated'], 201);
            }
        }
    }

    public function delete_student(Request  $request)
    {
        $request->validate(['Student_id' => 'required|integer|exists:Students']);

        Student::where('Student_id', $request->Student_id)->delete();

        return response()->json(['Success' => "Student deleted"], 201);
    }

   

    public function list_stu(Request $request)
    {
        $s=0;
        $arr=[];
        $request->validate(['all' => 'numeric|min:1|not_in:0']);

         if ($request->dep_id && $request->sec_id ) 
         {
            $request->validate(['dep_id' => 'integer|exists:Departments','sec_id' => 'integer|exists:Sections']);
            $s = Student::where('dep_id', $request->dep_id)->where('sec_id', $request->sec_id)->get();
        } 

        else if ($request->Student_id) 
        {
            $request->validate(['Student_id' => 'integer|exists:Students']);
            $s = Student::where('Student_id', $request->Student_id)->get();

        }
         else if ($request->lvl)
          {
            $request->validate(['lvl' => 'integer|between:1,4']);
            $s = Student::where('lvl', $request->lvl)->get();

        } else if ($request->adv_id) 
        {
            $request->validate(['adv_id' => 'integer|exists:Users,id']);
            $advisor=User::where('id',$request->adv_id)->first();
            if($advisor->type!=2){ return response()->json(['err'=>"this not adv id"]);}
            $s = Student::where('adv_id', $request->adv_id)->get();

        } else if ($request->first_name && $request->last_name) 
        {
            $request->validate(['last_name' => 'string|exists:Users', 'first_name' => 'string|exists:Users']);
            $user = User::where('first_name', $request->first_name)->where('last_name', $request->last_name)
                        ->where('type',1)->get();
            
            for ($i = 0; $i < $user->count(); $i++) 
            {
                    $s = Student::where('Student_id', $user[$i]->id)->get();

                    $arr[]=  ["record"=>$s,"Student Name"=>$user[$i]->first_name] ;   
            }
            return $arr;
           
        }

        else if ($request->all) 
        {
            $s = Student::all();
        }
        
        if(!$s){ return response()->json(['err'=>"enter choice"]);}
        return response()->json(['success' =>  $s], 201); 
    }
}
