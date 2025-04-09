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
        $tasks = Task::factory(10)->create();
        TaskSubmission::factory(10)->create();
        $classrooms = Classroom::all();

        foreach ($tasks as $task) {
            // Get 1-5 random classrooms (adjust the range as needed)
            $classroomsToAssign = $classrooms->random(rand(1, 5));
        
            foreach ($classroomsToAssign as $classroom) {
                DB::table('class_task')->insert([
                    'task_id' => $task->id,
                    'class_id' => $classroom->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        foreach ($tasks as $task) {
            DB::table('task_resource')->insert([
                'task_id' => $task->id,
                'file_path' => 'uploads/' . Str::uuid() . '.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };
    }

    
}
