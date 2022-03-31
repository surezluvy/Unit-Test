<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('edit-store', 1) }}" method="post" id="edit_task_1">
        @csrf
        <input type="text" name="name">
        <textarea name="description"></textarea>
        <input type="submit" value="Update Task">
    </form>
    <h1>Tasks Management</h1>
    <ul>
        @foreach ($tasks as $task)
            <a href="{{ route('task-edit', $task->id) }}" id="edit_task_{{ $task->id }}">Edit</a>
            <li>
                {{ $task->name }}<br>
                {{ $task->description }}
            </li>
        @endforeach
    </ul>

</body>
</html>
