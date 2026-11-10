<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t033_krs', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel mahasiswa (user) dan mata kuliah
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('mata_kuliah_id');
            
            // Data KRS
            $table->string('semester');
            $table->string('status')->default('Diajukan'); // Default status saat baru ambil matkul

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t033_krs');
    }
};