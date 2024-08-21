<?php

namespace Database\Factories;

use App\Models\TaskPriority;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskPriorityFactory extends Factory
{
    protected $model = TaskPriority::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
