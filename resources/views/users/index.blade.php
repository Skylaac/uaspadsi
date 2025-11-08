@extends('layouts.app')

@section('title', 'Data Users')

@section('content')
<div class="max-w-6xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">👤 Data Users</h2>
        <a href="{{ route('users.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-md shadow-sm transition">
            + Tambah User
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
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">ID</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Email</th>
                    <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase">Role</th>
                    <th class="px-6 py-3 text-center font-semibold text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3">{{ $user->id_user }}</td>
                    <td class="px-6 py-3">{{ $user->nama }}</td>
                    <td class="px-6 py-3">{{ $user->email }}</td>
                    <td class="px-6 py-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $user->role == 'owner' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('users.edit', $user->id_user) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs">
                                Edit
                            </a>
                            <form action="{{ route('users.destroy', $user->id_user) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')" class="inline">
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
                    <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data user.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
