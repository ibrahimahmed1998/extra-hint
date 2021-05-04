<?php
namespace App\Http\Controllers\AUTH_USERS;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Update_user extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' => []]); }
   
    public function update_user(Request $req)
    {
        $req->validate([ 'id' => 'required|integer', ]);   
       
        $user = User::where('id', $req->id)->first();
        $all = User::get();
        $l = $user->count();

        if( $req->first_name && $req->last_name  )
        {
            $req->validate(['first_name'=>'min:3|max:20|string' , 'last_name' =>'min:3|max:20|string', ]);                 
            $user->update(['first_name'=>$req->first_name,'last_name'=>$req->last_name]);
        }

        if($req->type)
        {
            $req->validate([ 'type' => 'required|between:1,3|integer']); 
            $user->update(['type' => $req->type]);
        }

        if($req->email)
         {
            $req->validate(['email'=>'email:rfc,dns|unique:users']); 
                        
            for ($i = 0; $i < $l; $i++)
            {
               if ($req->email == $all[$i]->email && $user->id !=  $all[$i]->id) 
               {
                 return response()->json(['err'=>$req->email." attached with ".$all[$i]->first_name." ".$all[$i]->id],401);
               } 
           }

           $user->update(['email'=>$req->email]);
         }

         if($req->phone)
         {
            $req->validate(['phone' => 'numeric|regex:/(01)\d{9}/|digits:11|unique:users' ]);

            for ($i = 0; $i < $l; $i++)
             { 
              if($req->phone == $all[$i]->phone && $user->id !=  $all[$i]->id) 
               {
                 return response()->json(['err'=>$req->phone." attached with ".$all[$i]->first_name." ".$all[$i]->id], 401);
               }
             } 
             $user->update(['phone'=>$req->phone]);
         }

        return response()->json(['updated' => $user], 201);
    }
}
