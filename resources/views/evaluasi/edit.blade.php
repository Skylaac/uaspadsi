@extends('layouts.app')

@section('title', 'Edit Evaluasi')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8 border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Evaluasi</h2>

    <form action="{{ route('evaluasi.update', $evaluasi->id_evaluasi) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Karyawan</label>
           @extends('layouts.app')

@section('title', 'Edit Evaluasi')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8 border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Evaluasi</h2>

    <form action="{{ route('evaluasi.update', $evaluasi->id_evaluasi) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Karyawan</label>
            <select name="id_user" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}" {{ $evaluasi->id_user == $user->id_user ? 'selected' : '' }}>
                        {{ $user->nama }}
                    </option>
                @endforeach 
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
            <input type="text" name="periode" value="{{ $evaluasi->periode }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Penilaian Kerja</label>
            <select name="penilaian_kerja" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach(['Sangat Baik','Baik','Cukup','Kurang'] as $p)
                    <option value="{{ $p }}" {{ $evaluasi->penilaian_kerja == $p ? 'selected' : '' }}>{{ $p }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan</label>
            <textarea name="catatan" rows="4"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ $evaluasi->catatan }}</textarea>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
            <a href="{{ route('evaluasi.index') }}"
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
 <select name="id_user" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}" {{ $user->id_user == $evaluasi->id_user ? 'selected' : '' }}>
                        {{ $user->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
            <input type="text" name="periode" value="{{ $evaluasi->periode }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Penilaian Kerja</label>
            <select name="penilaian_kerja" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach(['Sangat Baik','Baik','Cukup','Kurang'] as $p)
                    <option value="{{ $p }}" {{ $evaluasi->penilaian_kerja == $p ? 'selected' : '' }}>{{ $p }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan</label>
            <textarea name="catatan" rows="4"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ $evaluasi->catatan }}</textarea>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
            <a href="{{ route('evaluasi.index') }}"
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
