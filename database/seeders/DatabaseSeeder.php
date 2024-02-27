<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => Hash::make('12345678'),
            'role'=>'admin'
        ]);

        // You can add more users as needed
        User::create([
            'name' => 'User',
            'email' => 'user@app.com',
            'password' => Hash::make('12345678'),
            'role'=>'admin'
        ]);
    }
}
