<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function fetch(User $receiver)
    {
        $query = Message::where([['sender_id', Auth::id()], ['receiver_id', $receiver->id]])
                    ->orWhere([['sender_id', $receiver->id], ['receiver_id', Auth::id()]]);
        $messages = $query->get();
        
        return $messages;
    }
    
    public function send(Request $request, Message $message)
    {
        $input = $request->input();
        $message->fill($input)->save();
        
        // broadcast(new SendMessage($message))->toOthers();
        return $message;
    }
}
