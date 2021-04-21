<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\Validate_change_pass;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Auth2_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup',]]);
    }

    public function verifyUser($verification_code)
    {
        $check = User::where('vcode', $verification_code)->first();
        if (!is_null($check)) {
            if ($check->email_verified_at != null) {
                return response()->json(['error' => "User Has Verified Before"], 401);
            } else {
                User::where('id', $check->id)->update(['email_verified_at' => now()]);
                return view('verifyUser_view');
            }
        } else {
            return response()->json(['error' => "Verification code is invalid."], 401);
        }
    }

    public function change_pass(Validate_change_pass  $request)
    {
        $user = Auth()->user();

        if ($user) {
            $x = Hash::check($request->password, $user->password);

            if (!$x) {
                return response()->json(["error" => " password is wrong "], 400);
            } else if ($request->password == $request->new_pass) {
                return response()->json(["error" => " Old password =  new password  "], 400);
            } else {
                User::where('id', $user->id)->update(array('password' => hash::make($request->new_pass)));
                return response()->json(["success" => "Password Changed Successfully "], 200);
            }
        }
    }

    public function sendresetpasswordemail(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->first();
        if ($user) {
            $token = mt_rand(000000, 999999);
            DB::table('password_resets')->insert([
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
                function ($mail) use ($email, $name, $subject) {
                    $mail->from('team3@facebookclone.com');
                    $mail->to($email, $name);
                    $mail->subject($subject);
                }
            );

            return response()->json(['success' => 'Check your email inbox for pin '], 200);
        } else {
            return response()->json(['success' => 'Check your email inbox for pin '], 200);
        }
    }

    public function confirm_pin(Request $request)
    {
        $user = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first(); //get()
        if ($user) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'invalid pin'], 422);
        }
    }

    public function resetpassword(Request $request)
    {
        $email = DB::table('password_resets')->where('token', $request->token)->where('email', $request->email)->first();
        if ($email) {
            $user = User::where('email', $request->email)->first();
            $user->password = $request->password;
            $user->save();
            DB::table('password_resets')->where('email', $request->email)->delete();
            $credentials = $request->only(['email', 'password']);
            if ($token = auth()->attempt($credentials)) {
                return $this->respondWithToken($token);
            } else {
                return response()->json('login failed');
            }
        } else {
            return response()->json(["error" => "Pin is not valid"], 422);
        }
    }
}