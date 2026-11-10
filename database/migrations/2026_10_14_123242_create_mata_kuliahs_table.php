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
        // Tambahkan awalan t033_
        Schema::create('t033_mata_kuliahs', function (Blueprint $table) {
            $table->id();
            
            // Kolom relasi dosen (opsional/nullable jika belum ada dosen yang mengajar)
            $table->unsignedBigInteger('dosen_id')->nullable(); 

            // Kolom data mata kuliah
            $table->string('kode_mk');
            $table->string('nama_mk');
            $table->integer('sks');
            $table->string('semester');
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pastikan nama di sini juga menggunakan awalan t033_
        Schema::dropIfExists('t033_mata_kuliahs');
    }
};