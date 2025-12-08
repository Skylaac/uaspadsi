@extends('layouts.app')

@section('title', 'Dashboard Karyawan')

@section('content')

@php
use Illuminate\Support\Facades\DB;
use App\Models\Absensi;
use App\Models\Evaluasi;

/* ----------------------------------------------------
    1. TOP 5 KEHADIRAN (Real Data)
---------------------------------------------------- */
$top5 = Absensi::where('keterangan', 'hadir')
    ->select('id_user', 'nama')
    ->get()
    ->groupBy('id_user')
    ->map(function ($items) {
        return [
            'nama' => $items->first()->nama,
            'total_hadir' => $items->count()
        ];
    })
    ->sortByDesc('total_hadir')
    ->take(5);

/* ----------------------------------------------------
    2. PENILAIAN KERJA (Real Data, No DB::raw)
---------------------------------------------------- */
$penilaian = Evaluasi::all()
    ->groupBy('penilaian_kerja')
    ->map->count();

$chartPenilaian = [
    'Sangat Baik' => $penilaian['Sangat Baik'] ?? 0,
    'Baik'        => $penilaian['Baik'] ?? 0,
    'Cukup'       => $penilaian['Cukup'] ?? 0,
    'Kurang'      => $penilaian['Kurang'] ?? 0,
];
@endphp


<div class="bg-gray-100 dark:bg-gray-900 min-h-screen p-6">

    {{-- HEADER --}}
    <div class="mb-10">
        <h1 class="text-4xl font-extrabold text-blue-900 dark:text-blue-300">SISKK</h1>
        <p class="text-lg text-blue-800 dark:text-blue-400">(Sistem Informasi Santai Kawan Kopi)</p>
    </div>

    {{-- TOTAL KARYAWAN --}}
    <div class="bg-white p-6 rounded-xl shadow-md mb-6 text-center">
        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300">Total Karyawan</h3>
        <p class="text-5xl font-extrabold mt-3 text-blue-700 dark:text-blue-400">
            {{ $totalKaryawan }}
        </p>
    </div>

    {{-- Karyawan Aktif Hari Ini (Radial) --}}
    <div id="chartAktifHariIni" class="bg-white p-6 rounded-xl shadow-md mb-6"></div>

    {{-- TOP 5 KEHADIRAN --}}
    <div id="chartTopKehadiran" class="bg-white p-6 rounded-xl shadow-md mb-6"></div>

    {{-- PENILAIAN KERJA --}}
    <div id="chartPenilaianKerja" class="bg-white p-6 rounded-xl shadow-md mb-6"></div>


    {{-- IMPORT DATA --}}
    <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">

        {{-- NOTIFIKASI --}}
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center">
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6 text-center">
            {{ $errors->first() }}
        </div>
        @endif

        <h2 class="text-2xl font-bold text-center text-blue-800 dark:text-blue-300 mb-6">
            Import Data Absensi (CSV)
        </h2>

        <form action="{{ route('absensi.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-gray-600 dark:text-gray-300 font-semibold mb-2">Pilih File CSV</label>
                <input type="file" name="file" accept=".csv" required
                    class="w-full p-3 border border-gray-300 dark:border-gray-700 dark:bg-gray-700 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="text-center">
                <button class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg shadow-md font-semibold">
                    Import Data
                </button>
            </div>

        </form>
    </div>

</div>


{{-- =====================================
     JAVASCRIPT CHARTS
===================================== --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    // ======================================================
    // 1. Karyawan Aktif Hari Ini (Radial)
    // ======================================================
    new ApexCharts(document.querySelector("#chartAktifHariIni"), {
        series: [{{ $karyawanAktif }}],
        chart: {
            type: 'radialBar',
            height: 330,
            toolbar: { show: false }
        },
        colors: ['#10B981'],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                gradientToColors: ['#34D399'],
                stops: [0, 100]
            }
        },
        plotOptions: {
            radialBar: {
                hollow: { size: "60%" },
                dataLabels: {
                    name: { fontSize: '20px', offsetY: -10 },
                    value: { fontSize: '36px', fontWeight: 'bold' }
                }
            }
        },
        labels: ['Karyawan Aktif']
    }).render();



    // ======================================================
    // 2. Top 5 Kehadiran
    // ======================================================
    var names = {!! json_encode($top5->pluck('nama')) !!};
    var hadir = {!! json_encode($top5->pluck('total_hadir')) !!};

    new ApexCharts(document.querySelector("#chartTopKehadiran"), {
        series: [{
            name: "Jumlah Kehadiran",
            data: hadir
        }],
        chart: {
            type: "bar",
            height: 360,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: "60%",
                borderRadius: 8
            }
        },
        colors: ["#4F46E5"],
        xaxis: {
            categories: names,
            title: { text: "Jumlah Hadir" }
        },
        dataLabels: {
            enabled: true,
            style: { fontSize: "14px" }
        },
        tooltip: {
            theme: "dark",
            y: {
                formatter: val => val + " hari"
            }
        }
    }).render();



    // ======================================================
    // 3. Penilaian Kerja (Pie Chart)
    // ======================================================
    var penilaianLabels = ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'];
    var penilaianValues = [
        {{ $chartPenilaian['Sangat Baik'] }},
        {{ $chartPenilaian['Baik'] }},
        {{ $chartPenilaian['Cukup'] }},
        {{ $chartPenilaian['Kurang'] }}
    ];

    new ApexCharts(document.querySelector("#chartPenilaianKerja"), {
        chart: {
            type: 'pie',
            height: 360
        },
        labels: penilaianLabels,
        series: penilaianValues,
        legend: {
            position: 'bottom'
        }
    }).render();

});
</script>

@endsection
