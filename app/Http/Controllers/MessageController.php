<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\SendMessage;


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
        //イベントの発火でpusherにデータを送る
        //toOthers()で自分自身を除外
        broadcast(new SendMessage($message))->toOthers();
        return $message;
    }
}
