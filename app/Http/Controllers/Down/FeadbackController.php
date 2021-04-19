<?php

namespace App\Http\Controllers\Down;

use App\Http\Controllers\Controller;
use App\Http\Requests\validate_Feedback;
 use App\Models\Feedbacks;

class FeadbackController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>  []]);
    }

    public function add_feedback(validate_Feedback $request)
    {
        $user = auth()->user();
        
        $feedback = Feedbacks::create(
            [
                'User_id' =>  $user->id,
                'ccode' => $request->ccode,
                'fheader' => $request->fheader,
                'fbody' => $request->fbody,
                'fvote' => $request->fvote,
             ]
        );
        return response()->json(['message' => 'Successfully Feedback'], 201);
    }
}