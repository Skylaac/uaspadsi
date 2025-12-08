@extends('layouts.app')

@section('title', 'Dashboard Karyawan')

@section('content')

<div class="bg-gray-100 dark:bg-gray-900 min-h-screen p-6">

    {{-- HEADER --}}
    <div class="mb-10">
        <h1 class="text-4xl font-extrabold text-blue-900 dark:text-blue-300">SISKK</h1>
        <p class="text-lg text-blue-800 dark:text-blue-400">(Sistem Informasi Santai Kawan Kopi)</p>
    </div>

    {{-- STAT + TOP RAJIN --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        {{-- TOTAL KARYAWAN --}}
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 flex flex-col items-center">
            <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300">Total Karyawan</h3>
            <p class="text-5xl font-extrabold mt-3 text-blue-700 dark:text-blue-400">
                {{ $totalKaryawan }}
            </p>
        </div>

        {{-- KARYAWAN AKTIF HARI INI --}}
        <div id="chartAktifHariIni"
            class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
        </div>

        {{-- TOP KARYAWAN PALING RAJIN --}}
        <div id="chartTopRajin"
            class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
        </div>

    </div>

    {{-- SECOND ROW --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- TOP PALING ALPHA --}}
        <div id="chartTopAlpha"
            class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
        </div>

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

</div>

{{-- CHART SCRIPT --}}
<script>
    // ------------------------------------------------------
    // 1. KARYAWAN AKTIF HARI INI
    // ------------------------------------------------------
    new ApexCharts(document.querySelector("#chartAktifHariIni"), {
        series: [{{ $karyawanAktif }}],
        chart: { type: 'radialBar', height: 300 },
        labels: ['Karyawan Aktif'],
        colors: ['#10B981'],
        plotOptions: {
            radialBar: {
                hollow: { size: '60%' }
            }
        }
    }).render();


    // ------------------------------------------------------
    // 2. TOP 3 KARYAWAN PALING RAJIN
    // ------------------------------------------------------
    var topRajinNames = {!! json_encode(array_column($topRajin, 'nama')) !!};
var topRajinValues = {!! json_encode(array_column($topRajin, 'persen')) !!};

    new ApexCharts(document.querySelector("#chartTopRajin"), {
        series: [{
            name: 'Kehadiran (%)',
            data: persenRajin
        }],
        chart: { type: 'bar', height: 300 },
        plotOptions: {
            bar: { horizontal: true, borderRadius: 6 }
        },
        colors: ['#16A34A'],
        xaxis: {
            categories: topRajinNames
        }
    }).render();


    // ------------------------------------------------------
    // 3. TOP 3 PALING SERING ALPHA
    // ------------------------------------------------------
    var topAlphaNames = {!! json_encode(array_column($topAlpha, 'nama')) !!};
var topAlphaValues = {!! json_encode(array_column($topAlpha, 'alpha')) !!};


    new ApexCharts(document.querySelector("#chartTopAlpha"), {
        series: [{
            name: 'Jumlah Alpha',
            data: alphaDays
        }],
        chart: { type: 'bar', height: 300 },
        plotOptions: {
            bar: { horizontal: true, borderRadius: 6 }
        },
        colors: ['#DC2626'],
        xaxis: {
            categories: topAlphaNames
        }
    }).render();

</script>

@endsection
