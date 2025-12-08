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
        // Ambil ID terakhir (string) misal EVL001
        $last = Evaluasi::orderBy('id_evaluasi', 'DESC')->first();

        if ($last) {
            // Ambil angka dari ID terakhir (EVL012 -> 12)
            $num = (int) substr($last->id_evaluasi, 3);
            $nextNum = $num + 1;
        } else {
            $nextNum = 1; // jika belum ada data sama sekali
        }

        // Generate ID baru (EVL001, EVL002, ...)
        $idEvaluasi = 'EVL' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

        Evaluasi::create([
            'id_evaluasi'     => $idEvaluasi,
            'id_user'         => $request->id_user,
            'nama'            => User::where('id_user', $request->id_user)->value('name'),
            'periode'         => $request->periode,
            'penilaian_kerja' => $request->penilaian_kerja,
            'catatan'         => $request->catatan,
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
            'id_user'         => $request->id_user,
            'nama'            => User::where('id_user', $request->id_user)->value('name'),
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
