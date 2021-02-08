<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User ; 
 

class AuthController extends Controller
{

    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','signin']]);
    }
*/
    public function __construct( )
{
    $this->middleware('auth:api', ['except' => ['login','signin']]);
    //$this->jwtAuth = $jwtAuth;
}



    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function signin( )
    {
       // $vcode = Str::random(70);
        //dd($vcode);
       
        $user = User::create(
            [
                'full_name' => request('full_name'),
                'password' => request('password'),
                'email' => request('email'),
                'phone' => request('phone'),
                'type'=> request('type')
            ]
        );

     //   Mail::to($user)->send(new verifyEmail($user->firstname, $vcode));

        return response()->json(['message' => 'Successfully sign up ,Look at your email inbox'], 201);
    }



    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
