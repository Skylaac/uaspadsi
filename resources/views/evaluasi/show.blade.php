@extends('layouts.app')

@section('title', 'Detail Evaluasi')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8 border border-gray-100">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📄 Detail Evaluasi</h2>

        <a href="{{ route('evaluasi.index') }}"
           class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
            Kembali
        </a>
    </div>

    {{-- Detail Card --}}
    <div class="space-y-6">

        {{-- User --}}
        <div>
            <p class="text-sm text-gray-500">Nama Karyawan</p>
            <p class="text-lg font-semibold text-gray-800">
                {{ $evaluasi->user->name ?? '-' }}
            </p>
        </div>

        {{-- Periode --}}
        <div>
            <p class="text-sm text-gray-500">Periode</p>
            <p class="text-lg font-semibold text-gray-800">
                {{ $evaluasi->periode }}
            </p>
        </div>

        {{-- Penilaian --}}
        <div>
            <p class="text-sm text-gray-500">Penilaian Kerja</p>

            @php
                $warna = [
                    'Sangat Baik' => 'bg-green-100 text-green-700',
                    'Baik'        => 'bg-blue-100 text-blue-700',
                    'Cukup'       => 'bg-yellow-100 text-yellow-700',
                    'Kurang'      => 'bg-red-100 text-red-700',
                ];
            @endphp

            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $warna[$evaluasi->penilaian_kerja] ?? 'bg-gray-100 text-gray-700' }}">
                {{ $evaluasi->penilaian_kerja }}
            </span>
        </div>

        {{-- Catatan --}}
        <div>
            <p class="text-sm text-gray-500">Catatan</p>
            <div class="mt-1 p-4 bg-gray-50 border border-gray-200 rounded-md text-gray-700">
                {{ $evaluasi->catatan }}
            </div>
        </div>

    </div>

    {{-- Tombol Aksi Owner --}}
    @if (Auth::user()->role === 'owner')
        <div class="flex justify-end gap-3 mt-8 border-t pt-6">
            <a href="{{ route('evaluasi.edit', $evaluasi->id_evaluasi) }}"
               class="px-5 py-2 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 transition">
                Edit
            </a>

            <form action="{{ route('evaluasi.destroy', $evaluasi->id_evaluasi) }}"
                  method="POST"
                  onsubmit="return confirm('Hapus data ini?')">
                @csrf
                @method('DELETE')

                <button class="px-5 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                    Hapus
                </button>
            </form>
        </div>
    @endif

</div>
@endsection
