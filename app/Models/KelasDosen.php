<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelasDosen extends Model
{
    protected $table = 't033_kelas_dosens';
    
    protected $fillable = ['dosen_id', 'mata_kuliah_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruang', 'semester'];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}