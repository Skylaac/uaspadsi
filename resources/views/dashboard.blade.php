@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-4xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Selamat Datang di Sistem Absensi 👋
    </h1>
    <p class="text-gray-600 mt-2">
        Anda sedang dalam mode <strong>tanpa login</strong>.  
        (Mode pengujian / pengembangan)
    </p>

    <div class="mt-6 space-x-3">
        <a href="{{ url('dashboard/absensi') }}" 
           class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">
           Lihat Data Absensi
        </a>

        <a href="{{ url('dashboard/jadwal') }}" 
           class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition">
           Lihat Jadwal
        </a>

        <a href="{{ url('dashboard/evaluasi') }}" 
           class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition">
           Lihat Evaluasi
        </a>

        <a href="{{ url('dashboard/users') }}" 
           class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition">
           Lihat Data User
        </a>
    </div>
</div>
@endsection
