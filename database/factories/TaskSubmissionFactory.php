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
            'student_id' => User::whereHas('roles', fn($q) => $q->where('name', 'student'))->inRandomOrder()->first()->id,
            'file_path' => 'submissions/' . fake()->uuid() . fake()->randomElement(['.pdf', '.docx', '.png', '.jpeg', '.pptx']),
            'grade' => fake()->randomElement([0, fake()->numberBetween(50,100)]),
        ];
    }
}
