<?php

namespace Tests\Unit;

use App\Jobs\SendTaskCompletionNotification;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Notifications\TaskCompletedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendTaskCompletionNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function it_sends_a_notification_when_job_is_dispatched(): void
    {
        Notification::fake();

        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'status_id' => TaskStatus::factory()->create([
                'name' => 'Completed'
            ])->id,
        ]);

        SendTaskCompletionNotification::dispatch($task);

        Notification::assertSentTo(
            $user,
            TaskCompletedNotification::class,
            function ($notification, $channels) use ($task) {
                return $notification->task->id === $task->id;
            }
        );
    }
}
