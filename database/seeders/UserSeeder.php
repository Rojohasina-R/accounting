<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Rojo',
            'isAdmin' => true,
            'email' => 'rojo@test.com',
            'password' => bcrypt('12345678'),
        ]);

        User::factory()->create([
            'name' => 'Test',
            'isAdmin' => false,
            'email' => 'test@test.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
