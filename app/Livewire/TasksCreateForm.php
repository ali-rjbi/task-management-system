<?php

namespace App\Livewire;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Models\TaskPriority;
use App\Models\TaskStatus;
use App\Services\TaskService;
use Livewire\Component;

class TasksCreateForm extends Component
{
    public $title;
    public $description;
    public $status_id;
    public $priority_id;
    public $due_date;
    public $statuses;
    public $priorities;

    public function __construct()
    {
    }

    public function mount(): void
    {
        $this->statuses = TaskStatus::all();
        $this->priorities = TaskPriority::all();
    }

    public function addTask(TaskService $taskService): void
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:task_statuses,id',
            'priority_id' => 'required|exists:task_priorities,id',
            'due_date' => 'nullable|date',
        ]);

        $taskService->createTask($validatedData + ['user_id' => auth()->id()]);

        $this->reset(['title', 'description', 'status_id', 'priority_id', 'due_date']);

        session()->flash('message', 'Task successfully added.');
    }

    public function render()
    {
        return view('livewire.tasks-create-form');
    }
}
