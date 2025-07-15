<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    // Buat user role pelanggan
    $user = \App\Models\User::create([
        'name' => 'Pelanggan Tes',
        'email' => 'pelanggan@example.com',
        'password' => bcrypt('password'),
        'role' => 'pelanggan',
    ]);

    // Buat pelanggan yang terhubung ke user di atas
    \App\Models\Pelanggan::create([
        'nama' => 'Pelanggan Tes',
        'alamat' => 'Jl. Contoh No. 1',
        'nomor_meteran' => '1234567890',
        'user_id' => $user->id,
    ]);
}

}
