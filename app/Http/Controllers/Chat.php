<?php

namespace App\Http\Controllers;

 use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\Message as ModelsMessage;

class Chat extends Controller
{
    public function __construct()  {  $this->middleware('auth');  }
    
    public function fetchMessages()
    {
      //return response()->json(['hello'=>'world']);
     //return response()->json(['hello']);

      return ModelsMessage::with('user')->get();
    }


  public function sendMessage(Request $request)
  {
    $user = Auth::user();

    $message = $user->messages()->create(['message' => $request->input('message')]);

    broadcast(new MessageSent($user, $message))->toOthers();

    return $this->fetchMessages();
    //return ['status' => 'Message Sent!'];
  }
}
