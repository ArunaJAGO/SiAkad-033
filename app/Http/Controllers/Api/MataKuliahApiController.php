<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahApiController extends Controller
{
    // 1. READ ALL: Tampilkan semua data mata kuliah
    public function index()
    {
        $mataKuliah = MataKuliah::all();
        return response()->json(['status' => 'success', 'data' => $mataKuliah], 200);
    }

    // 2. CREATE: Tambah mata kuliah baru
    public function store(Request $request)
    {
        // Validasi input (memastikan kode_mk unik di tabel t033_mata_kuliahs)
        $validated = $request->validate([
            'kode_mk'  => 'required|string|unique:t033_mata_kuliahs,kode_mk',
            'nama_mk'  => 'required|string',
            'sks'      => 'required|integer',
            'semester' => 'required|string',
        ]);

        $mataKuliah = MataKuliah::create($validated);
        
        return response()->json([
            'status'  => 'success', 
            'message' => 'Data Mata Kuliah berhasil ditambahkan', 
            'data'    => $mataKuliah
        ], 201);
    }

    // 3. READ ONE: Tampilkan detail satu mata kuliah berdasarkan ID
    public function show($id)
    {
        $mataKuliah = MataKuliah::find($id);
        
        if (!$mataKuliah) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }
        
        return response()->json(['status' => 'success', 'data' => $mataKuliah], 200);
    }

    // 4. UPDATE: Ubah data mata kuliah yang sudah ada
    public function update(Request $request, $id)
    {
        $mataKuliah = MataKuliah::find($id);
        
        if (!$mataKuliah) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }

        $mataKuliah->update($request->all());
        
        return response()->json([
            'status'  => 'success', 
            'message' => 'Data berhasil diperbarui', 
            'data'    => $mataKuliah
        ], 200);
    }

    // 5. DELETE: Hapus mata kuliah
    public function destroy($id)
    {
        $mataKuliah = MataKuliah::find($id);
        
        if (!$mataKuliah) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }

        $mataKuliah->delete();
        
        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus'], 200);
    }
}