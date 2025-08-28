<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus admin lama kalau ada
        User::where('email', 'admin@example.com')->delete();

        // Buat admin baru
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'), // password di-hash
            'role' => 'admin', // hapus kalau kolom role tidak ada
        ]);
    }
}
