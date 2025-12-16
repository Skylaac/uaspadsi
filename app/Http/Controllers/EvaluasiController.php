<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluasi;
use App\Models\User;

class EvaluasiController extends Controller
{
    public function index(Request $request)
{
    $penilaian = $request->penilaian; // ambil filter dari dropdown

    $evaluasi = Evaluasi::with('user')
        ->when($penilaian, function ($query) use ($penilaian) {
            return $query->where('penilaian_kerja', $penilaian);
        })
        ->get();

    return view('evaluasi.index', compact('evaluasi', 'penilaian'));
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
    // VALIDASI FORM
    $request->validate([
        'id_user' => 'required|exists:users,id_user',
        'periode' => 'required',
        'penilaian_kerja' => 'required',
        'catatan' => 'nullable',
    ]);

    // AMBIL USER (PASTI ADA)
    $user = User::where('id_user', $request->id_user)->firstOrFail();

    // GENERATE ID EVALUASI
    $last = Evaluasi::orderBy('id_evaluasi', 'DESC')->first();
    $nextNum = $last ? ((int) substr($last->id_evaluasi, 3) + 1) : 1;
    $idEvaluasi = 'EVL' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

    // SIMPAN DATA
    Evaluasi::create([
        'id_evaluasi'     => $idEvaluasi,
        'id_user'         => $user->id_user,
        'nama'            => $user->nama, // ← AMAN, TIDAK NULL
        'periode'         => $request->periode,
        'penilaian_kerja' => $request->penilaian_kerja,
        'catatan'         => $request->catatan,
    ]);

    return redirect()->route('evaluasi.index')
        ->with('success', 'Evaluasi berhasil ditambahkan');
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
            'id_user'         => $request->id_user,
            'nama'            => User::where('id_user', $request->id_user)->value('nama'),
            'periode'         => $request->periode,
            'penilaian_kerja' => $request->penilaian_kerja,
            'catatan'         => $request->catatan,
        ]);

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil diupdate');
    }

    public function destroy($id)
    {
        Evaluasi::findOrFail($id)->delete();
        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi berhasil dihapus');
    }
}
