@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8 border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Jadwal</h2>

    <form action="{{ route('jadwal.update', $jadwal->id_jadwal) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Karyawan</label>
            <select name="id_user" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}" {{ $user->id_user == $jadwal->id_user ? 'selected' : '' }}>
                        {{ $user->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
            <input type="date" name="tanggal" value="{{ $jadwal->tanggal }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Masuk</label>
                <input type="time" name="jam_masuk" value="{{ $jadwal->jam_masuk }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Pulang</label>
                <input type="time" name="jam_pulang" value="{{ $jadwal->jam_pulang }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Shift</label>
            <select name="shift" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach(['pagi', 'siang', 'malam'] as $s)
                    <option value="{{ $s }}" {{ $jadwal->shift == $s ? 'selected' : '' }}>
                        {{ ucfirst($s) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
            <a href="{{ route('jadwal.index') }}"
                class="px-5 py-2.5 rounded-md bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
                Kembali
            </a>
            <button type="submit"
                class="px-5 py-2.5 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
