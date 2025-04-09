<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for($i = 1; $i <=5; $i++){
            Classroom::create([
                'name' => 'XI - RPL ' . $i
            ]);  
        };

        $this->call([
            UserSeeder::class,
            LaratrustSeeder::class,
            TaskSeeder::class,
        ]);
        
    }
}
