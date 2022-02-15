<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(User $user)
    {
        // 自分以外のユーザーを取得
        $users = $user->where('id', '<>', Auth::id())->get();
        return view('chats/index')->with(['users' => $users]);
    }
    
    public function show(User $user)
    {
        return view('chats/show')->with(['receiver' => $user]);
    }
}
