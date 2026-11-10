<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = ['nama_role'];

    // Relasi balik ke tabel User (One-to-Many)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}