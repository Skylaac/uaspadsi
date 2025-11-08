@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8 border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit User</h2>

    <form action="{{ route('users.update', $user->id_user) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
            <input type="text" name="nama" value="{{ $user->nama }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Password (opsional)</label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak diganti"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
            <select name="role" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="karyawan" {{ $user->role == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
            </select>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
            <a href="{{ route('users.index') }}"
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
