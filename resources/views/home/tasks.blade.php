<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('store') }}" method="post">
        @csrf
        <input type="text" name="name">
        <textarea name="description"></textarea>
        <input type="submit" value="Create Task">
    </form>
    <h1>Tasks Management</h1>
    <ul>
        @foreach ($tasks as $task)
            <a href="{{ route('task-edit', $task->id) }}" id="edit_task_{{ $task->id }}">Edit</a>

            <form action="{{ route('delete-task', $task->id) }}" method="post">
                @csrf
                <input type="submit" id="delete_task_{{ $task->id }}">
            </form>

            <form action="{{ route('toggle-task', $task->id) }}" method="post">
                @csrf
                <input type="submit" value="Toggle" id="toggle_task_{{ $task->id }}">
            </form>
            <li>
                {{ $task->name }}<br>
                {{ $task->description }}
            </li>
        @endforeach
    </ul>

</body>
</html>
