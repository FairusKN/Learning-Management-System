<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskSubmission>
 */
class TaskSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => Task::factory(),
            'student_id' => User::inRandomOrder()->first()->hasRole('student')->id ?? User::factory()->create()->addRole('student')->id,
            'file_path' => 'submissions/' . fake()->uuid() . '.pdf',
            'grade' => fake()->randomElement([0, fake()->numberBetween(20,100)]),
        ];
    }
}
