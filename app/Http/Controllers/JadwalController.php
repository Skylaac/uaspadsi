<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('user')->orderBy('tanggal', 'desc')->get();
        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $users = User::all();
        return view('jadwal.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'shift' => 'required|in:pagi,siang,malam',
        ]);

        // Generate ID jadwal otomatis
        do {
            $last = Jadwal::latest('id_jadwal')->first();
            $lastId = $last ? (int) substr($last->id_jadwal, 1) : 0;
            $newId = 'J' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        } while (Jadwal::where('id_jadwal', $newId)->exists());

        Jadwal::create([
            'id_jadwal' => $newId,
            'id_user' => $request->id_user,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'shift' => $request->shift,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::where('id_jadwal', $id)->firstOrFail();
        $users = User::all();
        return view('jadwal.edit', compact('jadwal', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'shift' => 'required|in:pagi,siang,malam',
        ]);

        $jadwal = Jadwal::where('id_jadwal', $id)->firstOrFail();
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::where('id_jadwal', $id)->firstOrFail();
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
