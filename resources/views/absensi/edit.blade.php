@extends('layouts.app')

@section('title', 'Edit Absensi')
@section('content')
<div class="container mt-4">
    <h2>Edit Data Absensi</h2>
    <form action="{{ route('absensi.update', $absensi->id_absensi) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Karyawan</label>
            <select name="id_user" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}" {{ $absensi->id_user == $user->id_user ? 'selected' : '' }}>
                        {{ $user->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $absensi->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <select name="keterangan" class="form-control">
                @foreach(['hadir', 'izin', 'sakit', 'alpha'] as $ket)
                    <option value="{{ $ket }}" {{ $absensi->keterangan == $ket ? 'selected' : '' }}>
                        {{ ucfirst($ket) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jam Masuk</label>
            <input type="time" name="jam_masuk" class="form-control" value="{{ $absensi->jam_masuk }}">
        </div>

        <div class="mb-3">
            <label>Jam Pulang</label>
            <input type="time" name="jam_pulang" class="form-control" value="{{ $absensi->jam_pulang }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
