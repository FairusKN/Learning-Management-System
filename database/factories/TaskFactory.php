<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    public function definition(): array
    {
        $title = fake()->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),
            'teacher_id' =>  User::whereHas('roles', fn($q) => $q->where('name', 'teacher'))->inRandomOrder()->first()->id,            
            'resource_path' => 'uploads/' . Str::uuid() . '.pdf',
        ];
    }
}
