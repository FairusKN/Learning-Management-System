<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Classroom;
use App\Models\TaskSubmission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskSubmission::factory(10)->create();
        $tasks = Task::all();
        $classrooms = Classroom::all();

        foreach ($tasks as $task) {
            if ($task->classes()->count() === 0) {
                $randomClassrooms = $classrooms->random(rand(1, $classrooms->count()))->pluck('id');
                $task->classes()->attach($randomClassrooms);
            }
        }
    }
}
