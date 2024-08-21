<?php

namespace App\Livewire;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TasksList extends Component
{
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
        $tasks = $this->taskService->getTasks([],15);
        return view('livewire.tasks-list',compact('tasks'));
    }

    protected function getListeners()
    {
        return [
            'echo:tasks,TaskCreated' => 'getRealTimeTask',
        ];
    }

    public function getRealTimeTask(Task $task)
    {
        Log::debug('notifyNewTask',[
            'task' => $task
        ]);
    }
}
