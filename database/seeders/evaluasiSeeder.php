<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class evaluasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('evaluasi')->insert([
            [
                'id_evaluasi' => 'EV001',
                'id_user' => 'USR001',
                'periode' => 'Oktober 2025',
                'penilaian_kerja' => 'Baik',
                'catatan' => 'Tepat waktu dan disiplin.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_evaluasi' => 'EV002',
                'id_user' => 'USR002',
                'periode' => 'Oktober 2025',
                'penilaian_kerja' => 'Cukup',
                'catatan' => 'Perlu peningkatan kehadiran.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_evaluasi' => 'EV003',
                'id_user' => 'USR003',
                'periode' => 'Oktober 2025',
                'penilaian_kerja' => 'Sangat Baik',
                'catatan' => 'Kerja malam sangat konsisten.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_evaluasi' => 'EV004',
                'id_user' => 'USR004',
                'periode' => 'September 2025',
                'penilaian_kerja' => 'Baik',
                'catatan' => 'Menunjukkan progres positif.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_evaluasi' => 'EV005',
                'id_user' => 'USR005',
                'periode' => 'September 2025',
                'penilaian_kerja' => 'Kurang',
                'catatan' => 'Terlambat beberapa kali.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
