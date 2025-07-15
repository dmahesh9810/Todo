<!DOCTYPE html>
<html>
<head>
    <title>Todo App</title>
</head>
<body>
    <h1>Todo List</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Task Create Form -->
    <form method="POST" action="/tasks">
        @csrf
        <input type="text" name="title" placeholder="Enter task title">
        <button type="submit">Add Task</button>
    </form>

    <!-- Task List -->
<ul>
    @foreach ($tasks as $task)
        <li>
            {{ $task->title }}

            <!-- Delete Form -->
            <form method="POST" action="/tasks/{{ $task->id }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>

            <!-- Edit Link -->
            <a href="/tasks/{{ $task->id }}/edit">Edit</a>

            <!-- Complete / Completed Display -->
            @if (!$task->completed)
                <form method="POST" action="/tasks/{{ $task->id }}/complete" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Mark Complete</button>
                </form>
            @else
                ✅ Completed
            @endif
        </li>
    @endforeach
</ul>


</body>
</html>
