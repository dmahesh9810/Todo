<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task;

Route::get('/', function () {
    $tasks = Task::all();
    return view('tasks.index', compact('tasks'));
});

Route::post('/tasks', [TaskController::class, 'store']);

Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
Route::put('/tasks/{task}', [TaskController::class, 'update']);
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit']);
Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete']);


