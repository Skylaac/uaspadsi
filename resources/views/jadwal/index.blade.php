@extends('layouts.app')

@section('title', 'Data Jadwal')

@section('content')
<div class="max-w-6xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📅 Data Jadwal</h2>
        <a href="{{ route('jadwal.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-md shadow-sm transition">
            + Tambah Jadwal
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Jam Masuk</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Jam Pulang</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Shift</th>
                    <th class="px-6 py-3 text-center font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($jadwals as $jadwal)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3">{{ $jadwal->id_jadwal }}</td>
                    <td class="px-6 py-3">{{ $jadwal->user->nama ?? '-' }}</td>
                    <td class="px-6 py-3">{{ $jadwal->tanggal }}</td>
                    <td class="px-6 py-3">{{ $jadwal->jam_masuk }}</td>
                    <td class="px-6 py-3">{{ $jadwal->jam_pulang }}</td>
                    <td class="px-6 py-3 capitalize">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            @if($jadwal->shift == 'pagi') bg-yellow-100 text-yellow-700
                            @elseif($jadwal->shift == 'siang') bg-green-100 text-green-700
                            @else bg-blue-100 text-blue-700 @endif">
                            {{ $jadwal->shift }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('jadwal.edit', $jadwal->id_jadwal) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs">
                                Edit
                            </a>
                            <form action="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data jadwal.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
