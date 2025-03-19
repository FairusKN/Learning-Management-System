<?php

namespace Database\Seeders;

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
        $testUser->addRole('admin');

    }
}
