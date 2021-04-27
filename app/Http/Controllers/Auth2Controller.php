<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\password_resets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Auth2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup','sendresetpasswordemail','resetpassword']]);
    }

    public function verifyUser($verification_code) /////////////////////////////////////////////////
    {
        $check = User::where('vcode', $verification_code)->first();
        if (!is_null($check)) {
            if ($check->email_verified_at != null) {
                return response()->json(['err' => "User Has Verified Before"], 401);
            } else {
                User::where('id', $check->id)->update(['email_verified_at' => now()]);
                return view('verifyUser_view');
            }
        } else {
            return response()->json(['err' => "Verification code is invalid."], 401);
        }
    }

    public function change_pass(Request  $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'new_pass' => 'required|min:8|required_with:conifrm_new_pass|same:conifrm_new_pass'  
              ]
        );

        $user = Auth()->user();

        if ($user) 
        {
            $x = Hash::check($request->password, $user->password);

            if (!$x) {
                return response()->json(["err" => " password is wrong "], 400);
            } else if ($request->password == $request->new_pass) {
                return response()->json(["err" => " Old password =  new password  "], 400);
            } else {
                User::where('id', $user->id)->update(array('password' => hash::make($request->new_pass)));
                return response()->json(["success" => "Password Changed Successfully "], 200);
            }
        }
    }

    public function sendresetpasswordemail(Request $request)
    {
        $request->validate([ 'email' => 'required|exists:Users|email:rfc,dns',])  ;       

        $user = User::where('email',$request->email)->first();

        if ($user)
         {
            $token = mt_rand(000000, 999999);
            DB::table('password_resets')->insert(
                [
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
              ]);
            $email = $request->email;
            $name = $user->firstname;
            $subject = 'Resetting Password';
            Mail::send(
                'sendrestpassemail',
                ['name' => $user->firstname, 'token' => $token],
                function ($mail) use ($email, $name, $subject)
                 {
                    $mail->from('backend@ams.com');
                    $mail->to($email, $name);
                    $mail->subject($subject);
                }
            );

            return response()->json(['success' => 'Check your email inbox for pin '], 200);
        } 
        else 
        {
            return response()->json(['err' =>'user not sign-up !'], 200);
        }
    }

    public function confirm_pin(Request $request)
    {
        $user =password_resets::where('email', $request->email)->where('token', $request->token)->first(); 
        if ($user) 
        {
            return response()->json(['success' => true]);
        } else 
        {
            return response()->json(['success' => false, 'message' => 'invalid pin'], 422);
        }
    }
    
    protected function respondWithToken($token)          
    {
        return response()->json(['token'=>$token,'expires_in'=>auth()->factory()->getTTL()*60 
        /*'token_type' => 'bearer',*/]);
    }
    

    public function resetpassword(Request $request)
    {
        $email = password_resets::where('token', $request->token)->where('email', $request->email)->first();
        
        if ($email)
         {
            $user = User::where('email', $request->email)->first();
            $user->password=$request->password;
            $user->save();
            password_resets::where('email', $request->email)->delete();

            $credentials = $request->only(['email', 'password']);
            if ($token = auth()->attempt($credentials)) {
                return $this->respondWithToken($token);
            } else {
                return response()->json('login failed');
            }
        } 
        else
         {
            return response()->json(["err" => "Pin is not valid"], 422);
        }
    }
}
