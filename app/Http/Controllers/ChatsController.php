<?php

namespace App\Http\Controllers;

 use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\Message as ModelsMessage;

class ChatsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    
    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
     
    
    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
      return ModelsMessage::with('user')->get();
    }
    
    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
{
  $user = Auth::user();

  $message = $user->messages()->create([
    'message' => $request->input('message')
  ]);

  broadcast(new MessageSent($user, $message))->toOthers();

  return ['status' => 'Message Sent!'];
}

    
}
