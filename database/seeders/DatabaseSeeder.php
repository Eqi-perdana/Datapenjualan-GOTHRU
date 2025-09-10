<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah admin sudah ada
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        // Cek apakah karyawan sudah ada
        if (!User::where('email', 'karyawan@example.com')->exists()) {
            User::create([
                'name' => 'Karyawan',
                'email' => 'karyawan@example.com',
                'password' => Hash::make('123456'),
                'role' => 'karyawan',
            ]);
        }
    }
}
