<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class jadwalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal')->insert([
            [
                'id_user' => 'USR001',
                'tanggal' => '2025-11-03',
                'jam_masuk' => '08:00:00',
                'jam_pulang' => '16:00:00',
                'shift' => 'pagi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR002',
                'tanggal' => '2025-11-03',
                'jam_masuk' => '09:00:00',
                'jam_pulang' => '17:00:00',
                'shift' => 'siang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR003',
                'tanggal' => '2025-11-03',
                'jam_masuk' => '22:00:00',
                'jam_pulang' => '06:00:00',
                'shift' => 'malam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR004',
                'tanggal' => '2025-11-04',
                'jam_masuk' => '08:00:00',
                'jam_pulang' => '16:00:00',
                'shift' => 'pagi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR005',
                'tanggal' => '2025-11-04',
                'jam_masuk' => '09:00:00',
                'jam_pulang' => '17:00:00',
                'shift' => 'siang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
