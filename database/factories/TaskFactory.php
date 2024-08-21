<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskPriority;
use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'due_date' => Carbon::now()->addDays(rand(1,5)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'status_id' => TaskStatus::factory(),
            'priority_id' => TaskPriority::factory(),
        ];
    }
}
