@extends('layouts.app')

@section('title', 'Tambah Absensi')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8 border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 text-indigo-600">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Tambah Data Absensi
    </h2>

    {{-- Form --}}
    <form action="{{ route('absensi.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Nama Karyawan --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Karyawan</label>
            <select name="id_user" required
                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
                <option value="">-- Pilih Karyawan --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}">{{ $user->nama }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
            <input type="date" name="tanggal" required
                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
        </div>

        {{-- Keterangan --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
            <select name="keterangan"
                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alpha">Alpha</option>
            </select>
        </div>

        {{-- Jam Masuk --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Masuk</label>
                <input type="time" name="jam_masuk"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
            </div>

            {{-- Jam Pulang --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Pulang</label>
                <input type="time" name="jam_pulang"
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
            <a href="{{ route('absensi.index') }}"
                class="px-5 py-2.5 rounded-md bg-gray-200 text-gray-800 font-medium hover:bg-gray-300 transition">
                Kembali
            </a>
            <button type="submit"
                class="px-5 py-2.5 rounded-md bg-indigo-600 text-white font-medium hover:bg-indigo-700 shadow-sm transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
