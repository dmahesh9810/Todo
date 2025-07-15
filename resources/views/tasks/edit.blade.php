<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>

    <form method="POST" action="/tasks/{{ $task->id }}">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $task->title }}">
        <button type="submit">Update</button>
    </form>
</body>
</html>
