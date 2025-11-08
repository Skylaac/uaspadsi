<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class absensiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('absensi')->insert([
            [
                'id_user' => 'USR002',
                'nama' => 'Siti Aulia',
                'keterangan' => 'hadir',
                'jam_masuk' => '08:01:00',
                'jam_pulang' => '16:05:00',
                'tanggal' => '2025-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR003',
                'nama' => 'Rudi Hartono',
                'keterangan' => 'izin',
                'jam_masuk' => null,
                'jam_pulang' => null,
                'tanggal' => '2025-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR005',
                'nama' => 'Andi Pratama',
                'keterangan' => 'hadir',
                'jam_masuk' => '22:03:00',
                'jam_pulang' => '06:00:00',
                'tanggal' => '2025-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR002',
                'nama' => 'Siti Aulia',
                'keterangan' => 'sakit',
                'jam_masuk' => null,
                'jam_pulang' => null,
                'tanggal' => '2025-11-04',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USR003',
                'nama' => 'Rudi Hartono',
                'keterangan' => 'hadir',
                'jam_masuk' => '09:02:00',
                'jam_pulang' => '17:00:00',
                'tanggal' => '2025-11-04',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
