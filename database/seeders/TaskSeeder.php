<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskPriority;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $this->seederForTaskStatus();

        $this->seederForTaskPriority();

        $users = User::all();
        $statuses = TaskStatus::all();
        $priorities = TaskPriority::all();

        Task::factory(50)->create([
            'user_id' => fn() => $users->random()->id,
            'status_id' => fn() => $statuses->random()->id,
            'priority_id' => fn() => $priorities->random()->id,
        ]);
    }

    /**
     * @return void
     */
    public function seederForTaskStatus(): void
    {
        $statuses = ['Pending', 'In Progress', 'Completed', 'On Hold'];

        foreach ($statuses as $status) {
            TaskStatus::create(['name' => $status]);
        }
    }

    /**
     * @return void
     */
    public function seederForTaskPriority(): void
    {
        $priorities = ['Low', 'Medium', 'High', 'Critical'];

        foreach ($priorities as $priority) {
            TaskPriority::create(['name' => $priority]);
        }
    }
}
