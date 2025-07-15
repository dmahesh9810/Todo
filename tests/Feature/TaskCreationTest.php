<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCreationTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_task_can_be_created()
    {
        $response = $this->post('/tasks', [
            'title' => 'Buy milk'
        ]);

        $response->assertStatus(302); // Redirect after successful post
        $this->assertDatabaseHas('tasks', ['title' => 'Buy milk']);
    }

    public function test_task_title_is_required()
    {
        $response = $this->post('/tasks', [
            'title' => ''
        ]);

        $response->assertSessionHasErrors('title');
    }
    public function test_tasks_are_listed_on_home_page()
    {
        // Arrange: create a task in the database
        $task = \App\Models\Task::create([
            'title' => 'Do homework'
        ]);

        // Act: visit the homepage
        $response = $this->get('/');

        // Assert: check the response contains the task title
        $response->assertSee('Do homework');
    }
    public function test_a_task_can_be_deleted()
    {
        // Arrange: create a task
        $task = \App\Models\Task::create([
            'title' => 'Buy eggs'
        ]);

        // Act: send a DELETE request
        $response = $this->delete("/tasks/{$task->id}");

        // Assert: confirm the task is gone from the DB
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);

        // Optional: redirect or status
        $response->assertStatus(302); // Or ->assertRedirect('/')
    }
    public function test_a_task_can_be_updated()
    {
        // Arrange
        $task = \App\Models\Task::create([
            'title' => 'Original title'
        ]);

        // Act
        $response = $this->put("/tasks/{$task->id}", [
            'title' => 'Updated title'
        ]);

        // Assert
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated title'
        ]);

        $response->assertRedirect('/');
    }
    public function test_a_task_can_be_marked_as_complete()
    {
        // Arrange: create a task
        $task = \App\Models\Task::create([
            'title' => 'Test Task',
            'completed' => false
        ]);

        // Act: send PATCH request to mark complete
        $response = $this->patch("/tasks/{$task->id}/complete");

        // Assert: check the DB is updated
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => true
        ]);

        $response->assertRedirect('/');
    }
}
