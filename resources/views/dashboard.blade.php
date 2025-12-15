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


    {{-- ================================
         TOP 5 KEHADIRAN (with Title)
    ================================= --}}
    <div class="bg-white p-6 rounded-xl shadow-md mb-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Top 5 Kehadiran Karyawan</h3>
        <div id="chartTopKehadiran"></div>
    </div>


    {{-- ============================================================
         TOTAL KARYAWAN + PIE CHART PENILAIAN (in one row)
    ============================================================ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        {{-- TOTAL KARYAWAN --}}
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col justify-center items-center md:col-span-1">
            <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300">Total Karyawan</h3>
            <p class="text-5xl font-extrabold mt-3 text-blue-700 dark:text-blue-400">
                {{ $totalKaryawan }}
            </p>
        </div>

        {{-- PIE CHART + LEGEND --}}
        <div class="bg-white p-6 rounded-xl shadow-md md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">

            {{-- TITLE --}}
            <div class="col-span-3 mb-3">
                <h3 class="text-xl font-semibold text-gray-700">Distribusi Penilaian Kerja</h3>
            </div>

            {{-- PIE CHART --}}
            <div id="chartPenilaianKerja" class="col-span-2"></div>

            {{-- LEGEND --}}
            <div class="flex flex-col justify-center">
                <h3 class="text-lg font-semibold mb-3 text-gray-700">Keterangan Penilaian</h3>

                <ul class="space-y-3 text-gray-700">

                    <li class="flex items-center">
                        <span class="w-4 h-4 rounded-sm bg-[#3B82F6] mr-2"></span>
                        Sangat Baik: <b>{{ $chartPenilaian['Sangat Baik'] }}</b>
                    </li>

                    <li class="flex items-center">
                        <span class="w-4 h-4 rounded-sm bg-[#10B981] mr-2"></span>
                        Baik: <b>{{ $chartPenilaian['Baik'] }}</b>
                    </li>

                    <li class="flex items-center">
                        <span class="w-4 h-4 rounded-sm bg-[#F59E0B] mr-2"></span>
                        Cukup: <b>{{ $chartPenilaian['Cukup'] }}</b>
                    </li>

                    <li class="flex items-center">
                        <span class="w-4 h-4 rounded-sm bg-[#EF4444] mr-2"></span>
                        Kurang: <b>{{ $chartPenilaian['Kurang'] }}</b>
                    </li>

                </ul>
            </div>

        </div>

    </div>



    {{-- IMPORT DATA --}}
    <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">

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
    // 1. Top 5 Kehadiran
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
    // 2. Penilaian Kerja
    // ======================================================
    new ApexCharts(document.querySelector("#chartPenilaianKerja"), {
        chart: { type: 'pie', height: 360 },
        labels: ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'],
        series: [
            {{ $chartPenilaian['Sangat Baik'] }},
            {{ $chartPenilaian['Baik'] }},
            {{ $chartPenilaian['Cukup'] }},
            {{ $chartPenilaian['Kurang'] }}
        ],
        colors: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444'],
        legend: { show: false }
    }).render();

});
</script>

@endsection
