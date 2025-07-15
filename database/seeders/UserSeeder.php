<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Satu',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Pelanggan
        User::create([
            'name' => 'Pelanggan Satu',
            'email' => 'user@mail.com',
            'password' => Hash::make('user123'),
            'role' => 'pelanggan',
        ]);
    }
}