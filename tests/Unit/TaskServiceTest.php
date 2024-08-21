<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Mockery;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $taskService;
    protected $taskRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->taskRepository = Mockery::mock(TaskRepository::class);
        $this->taskService = new TaskService($this->taskRepository);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testCreateTask()
    {
        $taskData = [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'user_id' => 1,
            'status_id' => 1,
            'priority_id' => 1,
            'due_date' => now()->addDay()
        ];

        $task = Task::factory()->make($taskData);

        $this->taskRepository
            ->shouldReceive('create')
            ->once()
            ->with($taskData)
            ->andReturn($task);

        $createdTask = $this->taskService->createTask($taskData);

        $this->assertInstanceOf(Task::class, $createdTask);
        $this->assertEquals('Test Task', $createdTask->title);
    }

    public function testUpdateTask()
    {
        $taskId = 1;
        $user = User::factory()->create();
        $task = Task::factory()->create(['id' => $taskId, 'user_id' => $user->id, 'title' => 'Old Title']);


        $this->actingAs($user);

        $taskData = [
            'title' => 'New Title',
            'description' => 'Updated Description',
            'status_id' => 2,
            'priority_id' => 2,
        ];

        $this->taskRepository
            ->shouldReceive('findById')
            ->once()
            ->with($taskId)
            ->andReturn($task);

        $this->taskRepository
            ->shouldReceive('update')
            ->once()
            ->with($task, $taskData)
            ->andReturn(true);

        $result = $this->taskService->updateTask($taskId, $taskData);

        $this->assertTrue($result);
    }

    public function testDeleteTask()
    {
        $taskId = 1;
        $task = Task::factory()->make(['id' => $taskId, 'user_id' => 1]);

        Auth::shouldReceive('user')->andReturn((object)['id' => 1]);

        Gate::shouldReceive('authorize')
            ->once()
            ->with('delete', $task)
            ->andReturn(true);

        $this->taskRepository
            ->shouldReceive('findById')
            ->once()
            ->with($taskId)
            ->andReturn($task);

        $this->taskRepository
            ->shouldReceive('delete')
            ->once()
            ->with($task)
            ->andReturn(true);

        $result = $this->taskService->deleteTask($taskId);

        $this->assertTrue($result);
    }

    public function testTaskNotFound()
    {
        $taskId = 950;

        $this->taskRepository
            ->shouldReceive('findById')
            ->once()
            ->with($taskId)
            ->andReturn(null);

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        $this->taskService->getTaskById($taskId);
    }
}
