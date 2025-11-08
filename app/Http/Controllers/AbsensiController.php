<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // Menampilkan semua data absensi
    public function index()
    {
        $absensis = Absensi::with('user')->orderBy('tanggal', 'desc')->get();
        return view('absensi.index', compact('absensis'));
    }

    // Menampilkan form untuk menambah absensi
    public function create()
    {
        $users = User::all();
        return view('absensi.create', compact('users'));
    }

    // Menyimpan data absensi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'tanggal' => 'required|date',
            'keterangan' => 'required|in:hadir,izin,sakit,alpha',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_pulang' => 'nullable|date_format:H:i',
        ]);

        // Generate ID absensi baru otomatis
        do {
            $lastAbsensi = Absensi::latest('id_absensi')->first();
            $lastId = $lastAbsensi ? (int) substr($lastAbsensi->id_absensi, 1) : 0;
            $newId = 'A' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        } while (Absensi::where('id_absensi', $newId)->exists());

        $user = User::where('id_user', $request->id_user)->first();

        Absensi::create([
            'id_absensi' => $newId,
            'id_user' => $request->id_user,
            'nama' => $user->nama,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data absensi
    public function edit($id_absensi)
    {
        $absensi = Absensi::where('id_absensi', $id_absensi)->firstOrFail();
        $users = User::all();
        return view('absensi.edit', compact('absensi', 'users'));
    }

    // Mengupdate data absensi
    public function update(Request $request, $id_absensi)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'tanggal' => 'required|date',
            'keterangan' => 'required|in:hadir,izin,sakit,alpha',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_pulang' => 'nullable|date_format:H:i',
        ]);

        $absensi = Absensi::where('id_absensi', $id_absensi)->firstOrFail();
        $user = User::where('id_user', $request->id_user)->first();

        $absensi->update([
            'id_user' => $request->id_user,
            'nama' => $user->nama,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    // Menghapus data absensi
    public function destroy($id_absensi)
    {
        $absensi = Absensi::where('id_absensi', $id_absensi)->firstOrFail();
        $absensi->delete();

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus.');
    }
}
