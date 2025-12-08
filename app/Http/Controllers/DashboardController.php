<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Evaluasi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today     = Carbon::today();
        $bulanIni  = Carbon::now()->month;

        // 1. Total Karyawan
        $totalKaryawan = User::count();

        // 2. Hadir hari ini
        $karyawanAktif = Absensi::whereDate('tanggal', $today)->count();

        // 3. Total Jam Kerja Bulan Ini
        $absensiBulanIni = Absensi::whereMonth('tanggal', $bulanIni)->get();

        $totalJamKerja = 0;

        foreach ($absensiBulanIni as $absen) {
            if ($absen->jam_masuk && $absen->jam_pulang) {
                $jamMasuk  = Carbon::parse($absen->jam_masuk);
                $jamPulang = Carbon::parse($absen->jam_pulang);
                $totalJamKerja += $jamPulang->diffInHours($jamMasuk);
            }
        }

        // 4. Tingkat Kehadiran
        $jumlahAbsensi = Absensi::whereMonth('tanggal', $bulanIni)->count();
        $hariKerja = 22;
        $totalSeharusnya = $totalKaryawan * $hariKerja;

        $tingkatKehadiran = $totalSeharusnya > 0
            ? round(($jumlahAbsensi / $totalSeharusnya) * 100, 1)
            : 0;

        // 5. Top 3 Rajin
        $topRajin = User::withCount([
            'absensi as hadir_bulan_ini' => function ($q) use ($bulanIni) {
                $q->whereMonth('tanggal', $bulanIni);
            }
        ])
        ->get()
        ->map(function ($user) use ($hariKerja) {
            $user->persen = round(($user->hadir_bulan_ini / $hariKerja) * 100);
            return $user;
        })
        ->sortByDesc('persen')
        ->take(3)
        ->map(function ($user) {
            return [
                "nama" => $user->name,
                "persen" => $user->persen
            ];
        })
        ->values()
        ->toArray(); // ← FIX PENTING

        // 6. Top 3 Alpha
        $topAlpha = User::withCount([
            'absensi as hadir_bulan_ini' => function ($q) use ($bulanIni) {
                $q->whereMonth('tanggal', $bulanIni);
            }
        ])
        ->get()
        ->map(function ($user) use ($hariKerja) {
            $user->alpha = max($hariKerja - $user->hadir_bulan_ini, 0);
            return $user;
        })
        ->sortByDesc('alpha')
        ->take(3)
        ->map(function ($user) {
            return [
                "nama" => $user->name,
                "alpha" => $user->alpha
            ];
        })
        ->values()
        ->toArray(); // ← FIX PENTING


        // Jadwal & evaluasi
        $jadwalHariIni = Jadwal::whereDate('tanggal', $today)->count();
        $evaluasiBulanIni = Evaluasi::whereMonth('periode', $bulanIni)->count();


        // RETURN VIEW
        return view('dashboard', compact(
            'totalKaryawan',
            'karyawanAktif',
            'totalJamKerja',
            'tingkatKehadiran',
            'jadwalHariIni',
            'evaluasiBulanIni',
            'topRajin',
            'topAlpha'
        ));
    }
}
