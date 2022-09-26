<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Signup_;
use App\Http\Requests\Update_u;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\Providers\Auth;
  
class User_Data extends Controller
{
    public function add_user(Signup_ $rq)
    {       
        $user = User::create(['full_name' => Str::lower($rq->full_name),'password' => $rq->password,'email' => Str::lower($rq->email) ,'type' =>$rq->type, 'phone' =>$rq->phone, 'created_at'=>now() ]);
        if(!auth()->user()) { return redirect('/')->with('msg', "$user->full_name joined successfully as $user->type"); }
        return view('Serivce.general', ['msg'=>"$user->full_name joined successfully as $user->type"]);
    }

    public function change_pass(Request $rq)
    {
      $rq->validate([ 'password' => 'required|min:8',
          'new_pass' => 'required|min:8|required_with:conifrm_new_pass|same:conifrm_new_pass']);

      $user = Auth()->user();
        
      if(!(Hash::check($rq->password,$user->password))){
        return view('Serivce.general',['msg'=>"note : current password is wrong"]);
      } else if ($rq->password == $rq->new_pass) {
        return view('Home.main',['msg'=>"note : old pass equal new pass"]);
      } else {
        // User::where('id',$user->id)->update(array('password'=>hash::make($rq->new_pass)));
       $user = ['email'=>$user->email,'password'=>$rq->password];
      //  dd($user);
        FacadesAuth::attempt($user);
    
         //  return redirect()->route('home',['msg'=>"Password Changed Successfully"]);
          return view('Home.main',['msg'=>"Password Changed Successfully"]);
      }
    }

  public function user_update(Update_u $rq)
  {
        $user = User::where('id', $rq->id)->first();
        $users =User::get();
        $student="";

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

        $user->update($rq->all());

        if($user->type=='student')
        {
              //////////////// make it comment to quickly uploaaaaaaaaaaaaaaaaaaaaaad ////////////////
              // $x = new Auto_student();         $x->auto_student();    /********** AUTOMATIC *************/

          $rq->validate([
            'roadmap' =>'integer|between:1,2',
            'adv_id' => 'integer|exists:Users,id|different:Student_id',
            'dep_id' => 'integer|exists:Departments,dep_id',
            'sec_id' => 'integer|exists:Sections,sec_id',
        ]);

          $student = Student::where('user_id',$user->id)->first(); 

          /*
          {
            // wait until make drop down
            // $adv_name= User::where('id',$student->adv_id)->get()->first()->full_name; 


            // dd($adv_name);

            // if($rq->adv_id) 
            //  {
            //     $advisor = User::where('id', $rq->adv_id)->where('type',2)->first();
            //     $counter = Student::where('adv_id', $rq->adv_id)->get()->count();

            //     if (!$advisor) { return response()->json(['err' => "advisor not found"], 401); } 

            //     if($counter>=10) { return response()->json(['err'=>"can't follow advisor he has ".$counter." Students"],401); } 
                    
            //     else { $student->update(array('adv_id'=>$advisor->id));  }
            // 
          }
        */

        // $new = Student::where('user_id',$user->id)->update(['roadmap'=>$rq->roadmap]);

        DB::table('Students')->where('user_id',$user->id)->update([
          'roadmap' =>$rq->roadmap,
          'Dep_id' => 1,          // then i will make dropdown list 
          'Sec_id' => 1]);
    }

    return redirect('/all_users')->with('msg', "usre successfully updated");

}

public function del_user(Request $rq) 
{
    $rq->validate(['id' => 'integer|exists:Users']);
    User::find($rq->id)->delete();
    return redirect('/')->with('msg', "usre successfully deleted");
} 

public function del_student(Request $rq)
{
    $rq->validate(['Student_id' => 'required|integer|exists:Students']);
    Student::where('Student_id', $rq->Student_id)->delete();
    return response()->json(['Success' => "Student deleted"], 201);
}

}