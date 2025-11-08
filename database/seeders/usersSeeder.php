<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id_user' => 'USR001',
                'nama' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password123'),
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR002',
                'nama' => 'Siti Aulia',
                'email' => 'siti@example.com',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR003',
                'nama' => 'Rudi Hartono',
                'email' => 'rudi@example.com',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR004',
                'nama' => 'Dewi Lestari',
                'email' => 'dewi@example.com',
                'password' => Hash::make('password123'),
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR005',
                'nama' => 'Andi Pratama',
                'email' => 'andi@example.com',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
