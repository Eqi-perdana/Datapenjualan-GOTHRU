<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus karyawan lama kalau ada
        User::where('email', 'karyawan@example.com')->delete();

        // Buat user karyawan baru
        User::create([
            'name' => 'Karyawan',
            'email' => 'karyawan@example.com',
            'password' => Hash::make('123456'), // password di-hash
            'role' => 'karyawan', // hapus kalau kolom role tidak ada
        ]);
    }
}
