<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use Illuminate\Http\Request;

class KrsApiController extends Controller
{
    public function index() {
        // Mengambil data KRS beserta relasi ke tabel user (mahasiswa) dan mata kuliah
        return response()->json(['status' => 'success', 'data' => Krs::with(['mahasiswa', 'mataKuliah'])->get()], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:t033_users,id',
            'mata_kuliah_id' => 'required|exists:t033_mata_kuliahs,id',
            'semester' => 'required|string',
        ]);
        // Status default akan otomatis 'Diajukan' dari migrasi
        $krs = Krs::create($validated);
        return response()->json(['status' => 'success', 'message' => 'KRS berhasil ditambahkan', 'data' => $krs], 201);
    }

    public function show($id) {
        $krs = Krs::with(['mahasiswa', 'mataKuliah'])->find($id);
        return $krs ? response()->json(['status' => 'success', 'data' => $krs], 200) : response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
    }

    public function update(Request $request, $id) {
        $krs = Krs::find($id);
        if (!$krs) return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        $krs->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'KRS berhasil diupdate', 'data' => $krs], 200);
    }

    public function destroy($id) {
        $krs = Krs::find($id);
        if (!$krs) return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        $krs->delete();
        return response()->json(['status' => 'success', 'message' => 'KRS berhasil dihapus'], 200);
    }
}