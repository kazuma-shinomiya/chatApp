@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー一覧</div>

                <div class="card-body">
                    @foreach($users as $user)
                        <a href="/chats/{{ $user->id }}">{{ $user->name }}</a><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection