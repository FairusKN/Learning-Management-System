<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = ['RPL', 'TSM', 'TITL', 'TKR', 'TKJ', 'MP', 'MESIN'];

        // Old Way

        // $classes = array();

        // foreach ($majors as $major) {
        //     for ($i=1; $i  <=3 ; $i++) { 
        //         array_push($classes, $i . " - " . $major);
        //     }
            
        // }


        //Fancy Way that i dont even understand, thanks ChatGPT
        // ye im dumb

        $classes = collect($majors)->flatMap(function ($major) {
            return collect(range(10, 12))->map(function ($i) use ($major) {

                $romanNumber = ($i === 10) ? "X" : (($i === 11) ? "XI" : "XII");

                return [
                    'name' => "$romanNumber - $major",
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });
        })->toArray();

        // bulk insert, i know this one though

        Classroom::insert($classes);
        
    }
}
