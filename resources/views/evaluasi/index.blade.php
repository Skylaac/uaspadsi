@extends('layouts.app')

@section('title', 'Data Evaluasi')

@section('content')
<div class="max-w-6xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📊 Data Evaluasi</h2>
        <a href="{{ route('evaluasi.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-md shadow-sm transition">
            + Tambah Evaluasi
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
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Periode</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Penilaian</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Catatan</th>
                    <th class="px-6 py-3 text-center font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($evaluasis as $evaluasi)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3">{{ $evaluasi->id_evaluasi }}</td>
                    <td class="px-6 py-3">{{ $evaluasi->user->nama ?? '-' }}</td>
                    <td class="px-6 py-3">{{ $evaluasi->periode }}</td>
                    <td class="px-6 py-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($evaluasi->penilaian_kerja == 'Sangat Baik') bg-green-100 text-green-700
                            @elseif($evaluasi->penilaian_kerja == 'Baik') bg-blue-100 text-blue-700
                            @elseif($evaluasi->penilaian_kerja == 'Cukup') bg-yellow-100 text-yellow-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ $evaluasi->penilaian_kerja }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-gray-700">{{ $evaluasi->catatan ?? '-' }}</td>
                    <td class="px-6 py-3 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('evaluasi.edit', $evaluasi->id_evaluasi) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs">
                                Edit
                            </a>
                            <form action="{{ route('evaluasi.destroy', $evaluasi->id_evaluasi) }}" method="POST"
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
                    <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data evaluasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
