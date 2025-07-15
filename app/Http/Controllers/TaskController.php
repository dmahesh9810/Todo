<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        Task::create($request->validate([
            'title' => 'required'
        ]));

        return redirect('/');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/');
    }
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $task->update([
            'title' => $request->title
        ]);

        return redirect('/');
    }
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }
    public function complete(Task $task)
    {
        $task->update(['completed' => true]);
        return redirect('/');
    }
}
