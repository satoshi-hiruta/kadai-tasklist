@extends('layouts.app')

@section('content')
    @if (Auth::check())
        @if (count($tasks) > 0)
            @include('tasklists.tasks', ['tasklists' => $tasks])
        @endif
        {!! link_to_route('tasklists.create', '新規タスクの投稿', null, ['class' => 'btn btn-primary']) !!}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>タスクリストへようこそ！</h1>
                {!! link_to_route('signup.get', '今すぐサインアップ！', null, ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection