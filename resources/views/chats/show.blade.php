@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $receiver->name }}とのチャット</h1>
    <chat-component
        :sender-id="@json(Auth::id())"
        :receiver-id="@json($receiver->id)"
        endpoint ="/chats/{{ $receiver->id }}"
    ></chat-component>
    
</div>
@endsection