<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // Menggunakan model User dengan role Dosen
use Illuminate\Http\Request;

class DosenAkademikApiController extends Controller
{
    public function index() {
        // Ambil semua user yang memiliki role Dosen (misal role_id untuk Dosen adalah 2)
        $dosen = User::where('role_id', 2)->get();
        return response()->json(['status' => 'success', 'data' => $dosen], 200);
    }

    public function show($id) {
        $dosen = User::where('role_id', 2)->find($id);
        return $dosen ? response()->json(['status' => 'success', 'data' => $dosen], 200) : response()->json(['status' => 'error', 'message' => 'Dosen tidak ditemukan'], 404);
    }
}