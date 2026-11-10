<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanApiController extends Controller
{
    public function index() {
        return response()->json(['status' => 'success', 'data' => Pengumuman::all()], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'target_role' => 'required|string',
        ]);
        $pengumuman = Pengumuman::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Pengumuman berhasil dibuat', 'data' => $pengumuman], 201);
    }

    public function show($id) {
        $pengumuman = Pengumuman::find($id);
        return $pengumuman ? response()->json(['status' => 'success', 'data' => $pengumuman], 200) : response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
    }

    public function update(Request $request, $id) {
        $pengumuman = Pengumuman::find($id);
        if (!$pengumuman) return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        $pengumuman->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'Pengumuman berhasil diupdate', 'data' => $pengumuman], 200);
    }

    public function destroy($id) {
        $pengumuman = Pengumuman::find($id);
        if($pengumuman) $pengumuman->delete();
        return response()->json(['status' => 'success', 'message' => 'Pengumuman berhasil dihapus'], 200);
    }
}