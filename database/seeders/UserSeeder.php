<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456'), // password: 123456
                'role' => 'admin',
            ],
            [
                'name' => 'Karyawan User',
                'email' => 'karyawan@example.com',
                'password' => Hash::make('123456'), // password: 1234567
                'role' => 'karyawan',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // kunci unik
                $user // data yang akan diisi atau diperbarui
            );
        }
    }
}
