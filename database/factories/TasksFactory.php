<?php

namespace Database\Factories;

use App\Models\TaskList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tasklist = TaskList::factory()->create();
        
        return [
            'user_id' => $tasklist['user_id'],
            'list_id' => $tasklist['id'],
            'title' => fake()->name,
            'status' => 0,
        ];
    }
}
