@extends('layouts.app')

@section('title', 'Edit Absensi')

@section('content')
<div class="max-w-4xl mx-auto mt-8 bg-white shadow-md rounded-2xl p-8">

    {{-- Judul --}}
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        ✏️ Edit Absensi
    </h2>

    <form action="{{ route('absensi.update', $absensi->id_absensi) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Karyawan --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-1">Nama Karyawan</label>
            <select name="id_user"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                required>
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}" {{ $absensi->id_user == $user->id_user ? 'selected' : '' }}>
                        {{ $user->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-1">Tanggal</label>
            <input type="date" name="tanggal"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                value="{{ $absensi->tanggal }}" required>
        </div>

        {{-- Keterangan --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-1">Keterangan</label>
            <select name="keterangan"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                @foreach(['hadir', 'izin', 'sakit', 'alpha'] as $ket)
                    <option value="{{ $ket }}" {{ $absensi->keterangan == $ket ? 'selected' : '' }}>
                        {{ ucfirst($ket) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jam Masuk --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-1">Jam Masuk</label>
            <input type="time" name="jam_masuk"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                value="{{ $absensi->jam_masuk }}">
        </div>

        {{-- Jam Pulang --}}
        <div class="mb-8">
            <label class="block text-gray-700 font-medium mb-1">Jam Pulang</label>
            <input type="time" name="jam_pulang"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                value="{{ $absensi->jam_pulang }}">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('absensi.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-lg shadow-sm transition">
                Kembali
            </a>

            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-sm transition">
                Update
            </button>
        </div>

    </form>
</div>
@endsection
