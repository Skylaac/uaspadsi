<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluasi;
use App\Models\User;

class EvaluasiController extends Controller
{
    public function index()
    {
        $evaluasi = Evaluasi::with('user')->get();
        return view('evaluasi.index', compact('evaluasi'));
    }

    public function show($id)
    {
        $data = Evaluasi::with('user')->findOrFail($id);
        return view('evaluasi.show', compact('data'));
    }

    public function create()
    {
        $users = User::where('role', 'karyawan')->get();
        return view('evaluasi.create', compact('users'));
    }

    public function store(Request $request)
    {
        Evaluasi::create([
            'id_user' => $request->id_user,
            'periode' => $request->periode,
            'penilaian_kerja' => $request->penilaian_kerja,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $evaluasi = Evaluasi::findOrFail($id);
        $users = User::where('role', 'karyawan')->get();

        return view('evaluasi.edit', compact('evaluasi', 'users'));
    }

    public function update(Request $request, $id)
    {
        $data = Evaluasi::findOrFail($id);

        $data->update([
            'id_user' => $request->id_user,
            'periode' => $request->periode,
            'penilaian_kerja' => $request->penilaian_kerja,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil diupdate');
    }

    public function destroy($id)
    {
        Evaluasi::findOrFail($id)->delete();
        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil dihapus');
    }
}
