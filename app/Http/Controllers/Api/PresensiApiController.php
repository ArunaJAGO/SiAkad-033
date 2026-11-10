<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiApiController extends Controller
{
    public function index() {
        return response()->json(['status' => 'success', 'data' => Presensi::all()], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:t033_users,id',
            'mata_kuliah_id' => 'required|exists:t033_mata_kuliahs,id',
            'tanggal' => 'required|date',
            'status' => 'required|string',
        ]);
        $presensi = Presensi::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Presensi berhasil dicatat', 'data' => $presensi], 201);
    }

    public function show($id) {
        $presensi = Presensi::find($id);
        return $presensi ? response()->json(['status' => 'success', 'data' => $presensi], 200) : response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
    }

    public function update(Request $request, $id) {
        $presensi = Presensi::find($id);
        if (!$presensi) return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        $presensi->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'Presensi berhasil diupdate', 'data' => $presensi], 200);
    }

    public function destroy($id) {
        $presensi = Presensi::find($id);
        if($presensi) $presensi->delete();
        return response()->json(['status' => 'success', 'message' => 'Presensi berhasil dihapus'], 200);
    }
}