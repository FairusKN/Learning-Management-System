<?php

namespace Database\Seeders;

use App\Models\TaskSubmission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(LaratrustSeeder::class);

        $testUser = User::factory()->create([
            'name' => 'Fairus Kamal Nafis',
            'username' => 'fairus',
            'password' => 'fairus',
        ]);

        $testStudentUser = User::factory()->create([
            'name' => 'Test',
            'username' => 'test',
            'password' => 'test',
        ]);

        $testTeacherUser = User::factory()->create([
            'name' => 'Testt',
            'username' => 'testt',
            'password' => 'testt',
        ]);

        $testUser->addRole('admin');
        $testStudentUser->addRole('student');
        $testTeacherUser->addRole('teacher');


        TaskSubmission::factory(2)->for($testStudentUser, 'student')->create();
        TaskSubmission::factory(1)->for($testStudentUser, 'student')->create(["grade" => 30]);

    }
}
