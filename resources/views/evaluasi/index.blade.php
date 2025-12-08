@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                📊 Data Evaluasi
            </h3>

            @if (Auth::user()->role === 'owner')
                <a href="{{ route('evaluasi.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md shadow">
                    + Tambah Evaluasi
                </a>
            @endif
        </div>

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto shadow rounded-lg border border-gray-200">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700">
                        <th class="px-6 py-3 font-semibold">ID Evaluasi</th>
                        <th class="px-6 py-3 font-semibold">Nama Karyawan</th>
                        <th class="px-6 py-3 font-semibold">Periode</th>
                        <th class="px-6 py-3 font-semibold">Penilaian</th>
                        <th class="px-6 py-3 font-semibold">Catatan</th>
                        <th class="px-6 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($evaluasi as $e)
                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-3 text-gray-700">
                                {{ $e->id_evaluasi }}
                            </td>

                            <td class="px-6 py-3 text-gray-700">
                                {{ $e->user->nama }}
                            </td>

                            <td class="px-6 py-3 text-gray-700">
                                {{ $e->periode }}
                            </td>



                            {{-- Badge Warna Penilaian --}}
                            <td class="px-6 py-3">
                                @php
                                    $warna = [
                                        'Sangat Baik' => 'bg-green-100 text-green-700',
                                        'Baik' => 'bg-blue-100 text-blue-700',
                                        'Cukup' => 'bg-yellow-100 text-yellow-700',
                                        'Kurang' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp

                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold {{ $warna[$e->penilaian_kerja] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ $e->penilaian_kerja }}
                                </span>
                            </td>

                            <td class="px-6 py-3 text-gray-700">
                                {{ $e->catatan }}
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">


                                    @if (Auth::user()->role === 'owner')
                                        <a href="{{ route('evaluasi.edit', $e->id_evaluasi) }}"
                                            class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs rounded-md shadow">
                                            Edit
                                        </a>

                                        <form action="{{ route('evaluasi.destroy', $e->id_evaluasi) }}" method="POST"
                                            onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs rounded-md shadow">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 text-xs italic">
                                            tidak memiliki akses
                                        </span>
                                    @endif
                   

        </div>
        </td>
        </tr>

        @empty
            <tr>
                <td colspan="4" class="py-4 text-center text-gray-500">
                    Belum ada data evaluasi.
                </td>
            </tr>
            @endforelse
            </tbody>
            </table>
        </div>
        </div>
    @endsection
