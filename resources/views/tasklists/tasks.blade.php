<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>タスク</th>
            <th>ステータス</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasklists as $tasklist)
            <tr>
                <td>{!! link_to_route('tasklists.show', $tasklist->id, ['id' => $tasklist->id]) !!}</td>
                <td>{{ $tasklist->content }}</td>
                <td>{{ $tasklist->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $tasklists->render() !!}