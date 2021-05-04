<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Feedback_;
use App\Models\Feedbacks;
use Illuminate\Http\Request;

class Feedback98 extends Controller
{
    public function __construct() { $this->middleware('auth:api', ['except' =>  []]); }
 
    public function feedback98(Feedback_ $req)
    {
        $user = auth()->user();
        
         Feedbacks::create(
            [
                'User_id' =>  $user->id,
                'ccode' => $req->ccode,
                'fheader' => $req->fheader,
                'fbody' => $req->fbody,
                'fvote' => $req->fvote,
             ]
        );
        return response()->json(['Success' => 'Feedback added'], 201);
    }

    public function del_feedback98(Request $req)
    {
        $req->validate(['fid' => 'required|exists:Feedbacks']);

        Feedbacks::where('fid', $req->fid)->delete();
        return response()->json(['Success' => "Feedback deleted"], 201);
    }

    public function list_feedbacks()
    {
        $f = Feedbacks::all();
        return response()->json(['ALL Feedback' =>  $f], 201);
    }
}