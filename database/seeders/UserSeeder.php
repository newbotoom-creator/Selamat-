<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 1 user admin untuk login
        User::create([
            'name' => 'Admin MathEngine',
            'email' => 'admin@mathengine.com',
            'password' => Hash::make('password123'), // Gunakan Hash agar password aman
        ]);
    }
}