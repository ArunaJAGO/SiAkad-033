<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiApiController extends Controller
{
    public function index() {
        return response()->json(['status' => 'success', 'data' => Nilai::all()], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:t033_users,id',
            'mata_kuliah_id' => 'required|exists:t033_mata_kuliahs,id',
            'semester' => 'required|string',
            'nilai_akhir' => 'nullable|numeric',
            'nilai_huruf' => 'nullable|string'
        ]);
        $nilai = Nilai::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Nilai berhasil disimpan', 'data' => $nilai], 201);
    }

    public function show($id) {
        $nilai = Nilai::find($id);
        return $nilai ? response()->json(['status' => 'success', 'data' => $nilai], 200) : response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
    }

    public function update(Request $request, $id) {
        $nilai = Nilai::find($id);
        if (!$nilai) return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        $nilai->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'Nilai berhasil diupdate', 'data' => $nilai], 200);
    }

    public function destroy($id) {
        $nilai = Nilai::find($id);
        if($nilai) $nilai->delete();
        return response()->json(['status' => 'success', 'message' => 'Nilai berhasil dihapus'], 200);
    }
}