<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\Get_time;
use App\Models\enroll;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class Current_courses extends Controller
{   
    public function current_courses(Request $req)
    {
        $user = auth()->user(); $id= $user->id ;  $arr= [] ;
        
        if($req->Student_id)
        {
            $req->validate(['Student_id'=>'exists:Students|integer']);

            $id=$req->Student_id;

            $user=Student::where('user_id',$id)->first(); 

            $member = User::where('id',$user->user_id)->first();
        }
        else { $member = User::where('id',$id)->first(); }

        $gt=new Get_time();  $time=$gt->get_time();   $sem=$time['sem'];   $year=$time['year']; 

        $my_c = enroll::where('Student_id',$id)->where('year',$year)->where('semester',$sem)->get();

        return view('Serivce.user_data',['enrolled_courses'=>$my_c,'user'=>$member]);
    }
}
 // for ($i=0; $i <$my_c->count(); $i++) 
        // { 
        //     $arr[]=
        //     [ 
        //         "ccode" => $my_c[$i]->ccode,
        //         "hmedterm_d" =>$my_c[$i]->hmedterm_d,
        //         "hlab_d" =>$my_c[$i]->hlab_d,
        //         "horal_d" =>$my_c[$i]->horal_d,
        //         "hclass_work_d" =>$my_c[$i]->hclass_work_d,
        //         "hfinal_d" =>$my_c[$i]->hfinal_d,
        //         "htotal_d" =>$my_c[$i]->htotal_d,
        //         "signature" =>$my_c[$i]->signature
        //      ];
        // }
// return $arr ; 