<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\User;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    public function index()
    {
        $evaluasis = Evaluasi::with('user')->orderBy('periode', 'desc')->get();
        return view('evaluasi.index', compact('evaluasis'));
    }

    public function create()
    {
        $users = User::all();
        return view('evaluasi.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'periode' => 'required',
            'penilaian_kerja' => 'required|in:Sangat Baik,Baik,Cukup,Kurang',
            'catatan' => 'nullable|string',
        ]);

        // Generate ID evaluasi otomatis
        do {
            $last = Evaluasi::latest('id_evaluasi')->first();
            $lastId = $last ? (int) substr($last->id_evaluasi, 2) : 0;
            $newId = 'EV' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        } while (Evaluasi::where('id_evaluasi', $newId)->exists());

        Evaluasi::create([
            'id_evaluasi' => $newId,
            'id_user' => $request->id_user,
            'periode' => $request->periode,
            'penilaian_kerja' => $request->penilaian_kerja,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $evaluasi = Evaluasi::where('id_evaluasi', $id)->firstOrFail();
        $users = User::all();
        return view('evaluasi.edit', compact('evaluasi', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'periode' => 'required',
            'penilaian_kerja' => 'required|in:Sangat Baik,Baik,Cukup,Kurang',
            'catatan' => 'nullable|string',
        ]);

        $evaluasi = Evaluasi::where('id_evaluasi', $id)->firstOrFail();
        $evaluasi->update($request->all());

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $evaluasi = Evaluasi::where('id_evaluasi', $id)->firstOrFail();
        $evaluasi->delete();

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil dihapus.');
    }
}
