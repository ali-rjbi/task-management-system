<?php

namespace Tests\Feature;

use App\Traits\Responses\FormatsTaskErrorResponses;
use App\Traits\Responses\FormatsTaskResponses;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskPriority;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase,FormatsTaskResponses,FormatsTaskErrorResponses;

    public function testIndex()
    {
        Task::factory()->count(3)->create([
            'user_id' => User::factory()->create()->id,
        ]);

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $task->id]);
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $status = TaskStatus::factory()->create();
        $priority = TaskPriority::factory()->create();
        $taskData = [
            'title' => 'New Task',
            'description' => 'Task Description',
            'status_id' => $status->id,
            'priority_id' => $priority->id,
            'due_date' => now()->addDay()->toDateTimeString(),
        ];

        $response = $this->actingAs($user)->postJson('/api/tasks', $taskData);

        $response->assertStatus(201);
        $response->assertJsonFragment(['title' => 'New Task']);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'title' => 'Old Title'
        ]);
        $taskData = [
            'title' => 'Updated Title',
            'status_id' => $task->status_id,
            'priority_id' => $task->priority_id,
        ];

        $response = $this->actingAs($user)->putJson("/api/tasks/{$task->id}", $taskData);

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => self::$taskUpdatedMessage]);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function testGetUserTasks()
    {
        $user = User::factory()->create();
        Task::factory()->count(2)->for($user)->create();

        $response = $this->actingAs($user)->getJson('/api/tasks/user');

        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data');
    }

    public function testTaskNotFound()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson("/api/tasks/999");

        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => "Task not found with ID: 999"]);
    }

    public function testTaskDeleteWithInvalidId()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->deleteJson('/api/tasks/999999');

        $response->assertStatus(404);
    }
}
