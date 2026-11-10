<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presensi extends Model
{
    // Jika di migration tanpa 's', ganti jadi 't033_presensi'
    protected $table = 't033_presensis'; 
    
    protected $fillable = ['mahasiswa_id', 'dosen_id', 'mata_kuliah_id', 'tanggal', 'status', 'keterangan'];

    public function mahasiswa(): BelongsTo 
    { 
        return $this->belongsTo(User::class, 'mahasiswa_id'); 
    }

    public function dosen(): BelongsTo 
    { 
        return $this->belongsTo(User::class, 'dosen_id'); 
    }

    public function mataKuliah(): BelongsTo 
    { 
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id'); 
    }
}