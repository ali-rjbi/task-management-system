<?php

namespace App\Livewire;

use App\Models\TaskPriority;
use App\Models\TaskStatus;
use App\Services\TaskService;
use Livewire\Attributes\On;
use Livewire\Component;

class TasksEditForm extends Component
{
    public $taskId;
    public $task;
    public $title;
    public $description;
    public $status_id;
    public $priority_id;
    public $due_date;

    public $statuses = [];
    public $priorities = [];

    #[On('open-edit-drawer-task')]
    public function openEditDrawerTask($taskId, TaskService $taskService): void
    {
        $this->taskId = $taskId;

        $this->task = $taskService->getTaskById($this->taskId);
        $this->title = $this->task->title;
        $this->description = $this->task->description;
        $this->status_id = $this->task->status_id;
        $this->priority_id = $this->task->priority_id;
        $this->due_date = $this->task->due_date;

        $this->statuses = TaskStatus::all();
        $this->priorities = TaskPriority::all();
    }

    public function updateTask(TaskService $taskService): void
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:task_statuses,id',
            'priority_id' => 'required|exists:task_priorities,id',
            'due_date' => 'nullable|date',
        ]);

        $taskService->updateTask($this->task->id, $validatedData);

        $this->dispatch('notify_alert', 'Task successfully updated.');
        $this->dispatch('task-updated');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.tasks-edit-form');
    }
}
