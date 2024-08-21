<?php

namespace App\Livewire;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;

    public $showNewTaskNotification = false;

    protected $taskService;

    public function __construct()
    {
        $this->taskService = app(TaskService::class);
    }

    #[On('echo:tasks,TaskCreated')]
    public function notifyNewTask()
    {
        $this->showNewTaskNotification = true;
    }

    public function render()
    {
        $tasks = $this->taskService->getTasks([], 20);
        return view('livewire.tasks-list', compact('tasks'));
    }

    public function showTask($id)
    {
        $this->dispatch('show-task-modal', $id);
    }

    #[On('task-deleted')]
    #[On('task-updated')]
    public function refreshTasksList()
    {
        $this->resetPage();
    }

    public function getRealTimeTask(Task $task)
    {
        Log::debug('notifyNewTask', [
            'task' => $task
        ]);
    }

    public function getRealTimeTaskDeleted($taskId)
    {
        Log::debug('notifyDeletedTask', [
            'taskId' => $taskId
        ]);
    }

    public function getRealTimeTaskUpdated($taskId)
    {
        Log::debug('notifyUpdatedTask', [
            'taskId' => $taskId
        ]);
    }

    protected function getListeners()
    {
        return [
            'echo:tasks,TaskCreated' => 'getRealTimeTask',
            'echo:tasks,TaskDeleted' => 'getRealTimeTaskDeleted',
            'echo:tasks,TaskUpdated' => 'getRealTimeTaskUpdated',
        ];
    }
}
