@extends('layouts.app')

@section('content')

    <h1>id = {{ $task->id }} のタスク詳細ページ</h1>

    <p>{{ $task->content }}</p>
    <p>{{ $task->status }}</p>
    
    {!! link_to_route('tasklists.edit', 'このタスクを編集', ['id' => $task->id]) !!}

    {!! Form::model($task, ['route' => ['tasklists.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除') !!}
    {!! Form::close() !!}

@endsection