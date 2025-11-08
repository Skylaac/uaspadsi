@extends('layouts.app')

@section('title', 'Data Absensi')

@section('content')
<div class="max-w-6xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📋 Data Absensi</h2>
        <a href="{{ route('absensi.create') }}"
            class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-md shadow-sm transition">
            + Tambah Absensi
        </a>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-5l5-5-1.5-1.5L9 10.17 7.5 8.67 6 10l3 3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Jam Masuk</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Jam Pulang</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Keterangan</th>
                    <th class="px-6 py-3 text-center font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($absensis as $absensi)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 text-gray-700">{{ $absensi->id_absensi }}</td>
                        <td class="px-6 py-3 text-gray-800 font-medium">{{ $absensi->user->nama ?? '-' }}</td>
                        <td class="px-6 py-3 text-gray-700">{{ $absensi->tanggal }}</td>
                        <td class="px-6 py-3 text-gray-700">{{ $absensi->jam_masuk ?? '-' }}</td>
                        <td class="px-6 py-3 text-gray-700">{{ $absensi->jam_pulang ?? '-' }}</td>
                        <td class="px-6 py-3">
                            <span
                                class="
                                @if($absensi->keterangan == 'hadir') bg-green-100 text-green-700 
                                @elseif($absensi->keterangan == 'izin') bg-yellow-100 text-yellow-700 
                                @elseif($absensi->keterangan == 'sakit') bg-blue-100 text-blue-700 
                                @else bg-red-100 text-red-700 @endif
                                px-3 py-1 rounded-full text-xs font-semibold">
                                {{ ucfirst($absensi->keterangan) }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('absensi.edit', $absensi->id_absensi) }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-3 rounded-md text-xs transition">
                                    Edit
                                </a>
                                <form action="{{ route('absensi.destroy', $absensi->id_absensi) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-md text-xs transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data absensi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
