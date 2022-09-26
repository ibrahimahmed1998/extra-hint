<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Signup_;
use App\Http\Requests\Update_student_;
use App\Http\Requests\Update_u;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User_Data extends Controller
{
    public function add_user(Signup_ $req)
    {       
      $user = User::create(['full_name' => Str::lower($req->full_name),'password' => $req->password,'email' => Str::lower($req->email) ,'type' =>$req->type, 'phone' =>$req->phone, 'created_at'=>now() ]);
       
      if(!auth()->user())
      {return view('Home.main', ['msg' => $user->full_name ]);}

      return view('Serivce.general', ['msg' => $user->full_name ]);
    }

    public function del_user(Request $req) 
    {
        $req->validate(['id' => 'required|integer|exists:Users']);
        User::find($req->id)->delete();
        return response()->json(['success' => 'User  Deleted  '], 201);
    } 

    // add student data [ process name verify he is student]

    public function del_student(Request $req)
    {
        $req->validate(['Student_id' => 'required|integer|exists:Students']);
        Student::where('Student_id', $req->Student_id)->delete();
        return response()->json(['Success' => "Student deleted"], 201);
    }

    public function change_pass(Request $req)
    {
      $req->validate([
        'password' => 'required|min:8',
        'new_pass' => 'required|min:8|required_with:conifrm_new_pass|same:conifrm_new_pass'
      ]);

      $user = Auth()->user();

      if ($user) {
        $x = Hash::check($req->password, $user->password);

        if (!$x) {
          return response()->json(["err" => " password is wrong "], 400);
        } else if ($req->password == $req->new_pass) {
          return response()->json(["err" => "old pass = new pass"], 400);
        } else {
          User::where('id', $user->id)->update(array('password' => hash::make($req->new_pass)));

          return response()->json(["success" => "Pass changed"], 200);
        }
      }
    }

  public function user_update(Update_u $rq)
  {
        $user = User::where('id', $rq->id)->first();
        $users = User::get();

        foreach($users as $single => $value) {

             if($value->phone == $rq->phone)
             {
               if($value->id != $rq->id) 
               {  
                   return response()->json(['err' => "We have memeber with same phnoe number"], 401);  
               }
             }

             if($value->email == $rq->email)
             {
               if($value->id != $rq->id) 
               {  
                   return response()->json(['err' => "We have memeber with same email"], 401);  
               }
             }
        }

        // if(!$user) throw new Exception("user not found");

        $user->update($rq->all());
      //  dd($user);

      return view('Serivce.user_data',['user'=>$user]);
    }

    public function update_student(Update_student_ $req)  
    {
        $student = Student::where('Student_id', $req->Student_id);
        //////////////// make it comment to quickly uploaaaaaaaaaaaaaaaaaaaaaad ////////////////
      //  $x = new Auto_student();         $x->auto_student();    /********** AUTOMATIC *************/

        if ($req->roadmap) {$student->update(array('roadmap' => $req->roadmap));}

        if($req->dep_id && $req->sec_id) 
          {
            $student->update(array('dep_id'=>$req->dep_id,'sec_id'=>$req->sec_id));                    
          }

        if($req->adv_id) 
         {
            $advisor = User::where('id', $req->adv_id)->where('type',2)->first();
            $counter = Student::where('adv_id', $req->adv_id)->get()->count();

            if (!$advisor) { return response()->json(['err' => "advisor not found"], 401); } 

            if($counter>=10) { return response()->json(['err'=>"can't follow advisor he has ".$counter." Students"],401); } 
                 
            else { $student->update(array('adv_id'=>$advisor->id));  }
            
          }

        return response()->json(['Success' => $student->first()], 201);
    }
    

  }

        //   if ($user->type == 1) 
      //   {
      //       $sec = Section::where('Sec_id', $req->sec_id)->first();
      //       $dep = Department::where('dep_id', $req->dep_id)->first();

      //       if (!$sec || !$dep)
      //        {
      //           User::find($req->id)->delete();
      //           return response()->json(['err' => 'section or department not found'], 201);
      //        } 
      //       else
      //        {
      //           Student::create(['Student_id' => $req->id, 'lvl' =>1, 'roadmap' => 1 , 'live_hour' => 12,'c_gpa' => 0, 'dep_id' => $req->dep_id, 'sec_id' => $req->sec_id  ]);                  
      //           return response()->json(['success' => 'Student joins...AMS'], 201);
      //        }
      //   }
        