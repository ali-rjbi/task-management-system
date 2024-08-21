<?php

namespace App\Observers;

use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskUpdated;
use App\Jobs\ProcessHighPriorityTask;
use App\Jobs\SendTaskCompletionNotification;
use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        event(new TaskCreated($task));

        // Check if the task is high priority
        if ($task->priority->name === 'High') {
            // Dispatch the job to the high-priority queue
            ProcessHighPriorityTask::dispatch($task)->onQueue('high-priority');
        }
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        event(new TaskUpdated($task));

        if ($task->status->name === 'Completed') {
            // Dispatch the job to the high-priority queue
            SendTaskCompletionNotification::dispatch($task)->onQueue('high-priority');
        }

    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        event(new TaskDeleted($task->id));
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
