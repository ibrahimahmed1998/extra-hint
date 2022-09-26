<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class Deep_search extends Controller
{

    public function all_users()
    {
        $all_users = User::all();
        return view('Serivce.general', ['all_users' => $all_users]);
    }

    public function student_data(Request $req)
    {
        $req->validate(['id' => 'integer|exists:Users']);

        $user = User::where('id',$req->id)->first();
      
        if($user->type =='student')
        {
            $student = Student::where('user_id',$user->id)->get()->first();

            if(!$student)
            {
                Student::create(['user_id' => $user->id,'lvl'=> 1,'roadmap'=> 1,
                'live_hour'=>12,'c_gpa'=>0,'dep_id'=>1,'sec_id'=>1]);

                return view("Serivce.general", ["msg"=>"student activiated successfully"]);
             }
        }

        else{
            $student = null ;
        }
      
        $adv_name =""; $dname ="";$sname ="";

        if($student)
         {
            
            $adv_name = User::where('id',$student->adv_id)->get();
            $dname = Department::where('dep_id',$student->first()->Dep_id)->first()->dname ; 
            $sname = Section::where('Sec_id',$student->Sec_id)->first()->sec_name ; 
         }
        
        return view('Serivce.user_data', 
        ['user' => $user,
        'student'=>$student,
        'adv_name'=>$adv_name,
        'dname'=>$dname,
        'sname'=>$sname ]);
    }


    public function deep_search(Request $req)  
    {
        $arr= [] ; $arr2= [] ;

        $q =auth()->user();

        if($q->type==1)
        {
            return response()->json(['err'=>"not allowed for student"]);
        }

        $user=0;

        if ($req->first_name) 
        {
            if($req->last_name)
            {
                $req->validate(['last_name' => 'string|exists:Users','first_name' => 'string|exists:Users']);

                $user = User::where('first_name', $req->first_name)->where('last_name', $req->last_name)->get();
            }
            
            $req->validate(['first_name' => 'string|exists:Users']);
            $user = User::where('first_name', $req->first_name)->get();
        } 
        
        else if ( $req->first_name  && $req->last_name ) 
        {
            $user = User::where('first_name', $req->first_name)->where('last_name', $req->last_name)->get();
        } 
        
        else if ($req->id)
         {
            $req->validate(['id' => 'integer|exists:Users']);
            $user = User::where('id', $req->id)->get();
        }
         else if ($req->email) 
         {
            $req->validate(['email' => 'email:rfc,dns|exists:Users']);
            $user = User::where('email', $req->email)->get();

        }
         else if ($req->phone) 
         {
            $req->validate(['email' => 'email:rfc,dns|exists:Users']);
            $user = User::where('phone', $req->phone)->get();
        }

        if ($req->dep_id) 
        {

            if (! $req->sec_id) 
            {
                return response()->json(['err'=>"please enter sec_id"]);
            }
            
            $req->validate(['dep_id' => 'integer|exists:Departments', 'sec_id' => 'integer|exists:Sections']);
            $user = Student::where('dep_id', $req->dep_id)->where('sec_id', $req->sec_id)->get();
        } 

        else if ($req->lvl)
         {
            $req->validate(['lvl' => 'integer|between:1,4']);
            $user = Student::where('lvl', $req->lvl)->get();

         }

         else if ($req->adv_id) 
         {
            $req->validate(['adv_id' => 'integer|exists:Users,id']);
            $advisor=User::where('id',$req->adv_id)->first();
            if($advisor->type!=2){ return response()->json(['err'=>"this not adv id"]);}
            $user = Student::where('adv_id', $req->adv_id)->get();
         } 

         if($user==null)
         {
            return response()->json(['err'=>"please choose option"]);
         }

        for ($i=0; $i <$user->count() ; $i++) 
        { 
            if($user[$i]->type==1 || $user[$i]->lvl )
            {
                $arr[]=$user[$i] ; 
            }
            else
            {
                $arr2[]=$user[$i] ; 
            }
        }

        if(!$user) { return response()->json(['err'=>"enter choice"]);}
         return response()->json(['student' => $arr , 'others'=>$arr2], 201); 
    }}