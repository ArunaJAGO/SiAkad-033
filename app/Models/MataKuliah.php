<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataKuliah extends Model
{
    protected $table = 't033_mata_kuliahs';
    
    protected $fillable = ['dosen_id', 'kode_mk', 'nama_mk', 'sks', 'semester', 'deskripsi'];

    public function dosen(): BelongsTo { return $this->belongsTo(User::class, 'dosen_id'); }
    public function kelas(): HasOne { return $this->hasOne(KelasDosen::class, 'mata_kuliah_id'); }
    public function krs(): HasMany { return $this->hasMany(Krs::class, 'mata_kuliah_id'); }
    public function nilai(): HasMany { return $this->hasMany(Nilai::class, 'mata_kuliah_id'); }
    public function presensi(): HasMany { return $this->hasMany(Presensi::class, 'mata_kuliah_id'); }
}