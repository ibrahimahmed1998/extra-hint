<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\validate_Feedback;
use App\Models\Feedbacks;
use Illuminate\Http\Request;

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

    public function delete_feedback(Request $request)
    {
        $request->validate(['fid' => 'required|exists:Feedbacks']);

        Feedbacks::where('fid', $request->fid)->delete();
        return response()->json(['Sucessfully' => " Feedback deleted"], 201);
    }

    public function list_feedbacks()
    {
        $f = Feedbacks::all();
        return response()->json(['all feedbacks' =>  $f], 201);
    }
}