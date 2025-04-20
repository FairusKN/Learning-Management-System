<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;
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
       $name = fake()->name();

        return [
            'name' => $name,
            'username' => str_replace(' ', '_', $name),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }

    // public function admin()
    // {
    //     // return $this->state(function (array $attributes) {
    //     //     return $attributes;
    //     // })->afterCreating(function (User $user) {
    //     //     $user->addRole('admin');
    //     // });

    //     return $this->afterCreating(function (User $user){
    //         $user->addRole('admin');
    //     });
    // }

    // public function teacher()
    // {
    //     return $this->state(function (array $attributes) {
    //         return $attributes;
    //     })->afterCreating(function (User $user) {
    //         $user->addRole('teacher');
    //     });
    // }

    // public function student()
    // {
    //     return $this->state(function (array $attributes) {
    //         return $attributes;
    //     })->afterCreating(function (User $user) {
    //         $user->addRole('student');

    //         $classroom = Classroom::inRandomOrder()->first();
    
    //         if ($classroom) {
    //             $user->classes()->attach($classroom->id);
    //         }
    //     });
    // }

    // public function randomRole()
    // {
    //     return $this->state(function (array $attributes) {
    //         return $attributes;
    //     })->afterCreating(function (User $user) {
    //         // Randomly choose a role
    //         $role = fake()->randomElement(['student', 'teacher']);
            
    //         // Attach the chosen role
    //         $user->addRole($role);
            
    //         // If they're a student, assign to classroom
    //         if ($role === 'student') {
    //             $classroom = Classroom::inRandomOrder()->first();
    //             if ($classroom) {
    //                 $user->classrooms()->attach($classroom->id);
    //             }
    //         }
    //     });
    // }
    
    public function configure()
    {

        return $this->afterCreating(function (User $user){

            #$this->call(LaratrustSeeder::class);

            $role = fake()->randomElement(['student', 'teacher']);

            if (!$user->hasRole($role)) {
                $user->addRole($role);
            }
    
            if ($user->hasRole('student')) {
                $classroom = Classroom::inRandomOrder()->first();
                if ($classroom) {
                    $user->classes()->attach($classroom->id);
                }
            }
        });
    }
}
