<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'fatima',
        //     'email' => 'fatima@example.com',
        //     'password'=>bcrypt('12345678Aa@'),
        // ]);
//         User::create([
//    'name' => 'Fatima',
//    'email' => 'fatima@example.com',
//    'password' => Hash::make('12345678Aa@'),
// ]);
    }
}
