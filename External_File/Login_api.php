<?php
namespace App\Http\Controllers\AUTH_USERS;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
 
 
// class Login extends Controller{

//     public function __construct(){ $this->middleware('auth:api', ['except' => ['login']] );}

//     protected function respondWithToken($token)
//     {
//         // return response()->json(['token'=>$token,'expires_in' => auth()->factory()->getTTL() * 60]);
//         return response()->json([
//             'access_token' => $token,
//             'token_type' => 'bearer',
//             // 'expires_in' => auth('api')->factory()->getTTL() * 60
//         ]);
//     }

    // public function login(Request $req){
    //     $test_database=User::first();

    //     if(!$test_database){
    //         $root = User::create(['id' => 19980218,'first_name' =>'Ibrahim','last_name' =>'Ahmed','password' => 12345678,'email' => 'hema.1998.man@gmail.com','type' => 3 , 'phone' => "01207053244" , 'created_at'=>now() ]);
    //         return response()->json(['Root User'=> $root  ]);}

    //     $req->validate(['email' => 'required|email:rfc,dns', 'password' => 'required|min:8']);
        
    //     $credentials = $req->only('email', 'password');
        
    //     if ($token = auth()->attempt($credentials)){

    //         $this->respondWithToken($token);
    //         $user = auth()->user();

    //         if (Auth::attempt($credentials)) {  // \AUTH or use Auth; in first line

    //             $req->session()->regenerate();
    //         }
           
    //         $test = auth()->login($user); 

    //         // dd( \Auth::check() );  
    //         Auth::login($user);

    //         // dd( Auth::login($user));

//             $user = Auth::user();
//             dd(  Auth::login($user)        );
//             // dd(auth()->user()->first_name);
             
            
//             if ($user->type == 1){
//                 $s = Student::where('Student_id', $user->id)->first();

//                     return response()->json([
//                             "token" => $token,
//                             "first_name" => $user->first_name,
//                             "last_name" => $user->last_name,
//                             "phone" => $user->phone,
//                             "email" => $user->email,
//                             'type' =>  $user->type,
//                             "S_data" => $s
//             ]);}
            
//             // session()->flash('success','Your are Login ...');

//             return View::make ("Home/main",['data' => [
//                 "token" => $token,
//                 "id" => auth()->user()->id,
//                 "first_name" => $user->first_name,
//                 "last_name" => $user->last_name,
//                 "phone" => $user->phone,
//                 "email" => $user->email,
//                 'type' =>  $user->type   ]
//              ]);  
//              }
      
//         //  return response()->json(["token" => $token,"id" => auth()->user()->id,"first_name" => $user->first_name,"last_name" => $user->last_name,"phone" => $user->phone,"email" => $user->email,'type' =>  $user->type,   ]);}

//         else{
//             return View::make("Home/main",['err' => "Wrong Credintials ,Please Try a valid E-mail or password"]);
//             //return response()->json(['err' => "Wrong Credintials , Try a valid E-mail or password"], 401);
//          }

// }}
