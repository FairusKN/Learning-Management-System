<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => str_replace(' ', '_', fake()->name()),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
    
    public function configure()
    {
        return $this->afterCreating(function (User $user){
            $classroom = Classroom::inRandomOrder()->first();
            $user->classes()->attach($classroom->id);
        });
    }
}
