<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Classroom;
use App\Models\TaskSubmission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        $this->call(LaratrustSeeder::class);

        $testAdminUser = User::create([
            'name' => 'Fairus Kamal Nafis',
            'username' => 'fairus',
            'password' => Hash::make('fairus'),
        ]);

    
        $testStudentUser = User::create([
            'name' => 'Test',
            'username' => 'test',
            'password' => Hash::make('test'),
        ]);

    
        $testTeacherUser = User::create([
            'name' => 'Testt',
            'username' => 'testt',
            'password' => Hash::make('testt'),
        ]);


        $testAdminUser->addRole('admin');

        $testStudentUser->addRole('student');
        $classroom = Classroom::inRandomOrder()->first();
        $testStudentUser->classes()->attach($classroom->id);

        $testTeacherUser->addRole('teacher');

        TaskSubmission::factory(2)->create(['student_id' => $testStudentUser->id]);
        TaskSubmission::factory(1)->create(['student_id' => $testStudentUser->id,"grade" => 30]);
        TaskSubmission::factory(1)->create(['student_id' => $testStudentUser->id,"grade" => 99]);

        User::factory(20)->create();


    }
}
