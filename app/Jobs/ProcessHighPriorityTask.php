<?php

namespace App\Jobs;

use App\Models\Task;
use App\Notifications\HighPriorityTaskNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ProcessHighPriorityTask implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Task $task)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Log the processing of the task
        Log::info('Processing high-priority task', [
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
        ]);

        // Send a notification to the user about the high-priority task
        Notification::send($this->task->user, new HighPriorityTaskNotification($this->task));
    }
}
