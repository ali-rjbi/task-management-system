<?php

namespace App\Livewire;

use App\Services\TaskService;
use Livewire\Attributes\On;
use Livewire\Component;

class TasksModal extends Component
{
    public $showModal = false;
    public $task;

    protected $taskService;

    #[On('show-task-modal')]
    public function show($id, TaskService $taskService): void
    {
        $this->task = $taskService->getTaskById($id);
        $this->showModal = true;
    }

    public function edit($id): void
    {
        $this->dispatch('open-edit-drawer-task', $id);
        $this->closeModal();
    }

    public function delete($id, TaskService $taskService): void
    {
        try {
            $taskService->deleteTask($id);
            $this->closeModal();

            $this->dispatch('notify_alert', 'Task successfully deleted.');
            $this->dispatch('task-deleted');

            $this->reset();

        } catch (\Exception $e) {
            $this->dispatch('notify_alert', 'Task failed delete.');
        }
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.tasks-modal');
    }
}
