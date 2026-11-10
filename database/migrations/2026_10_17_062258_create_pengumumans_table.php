<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t033_pengumumans', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->string('judul');
            $table->text('isi');
            $table->string('target_role')->default('Semua'); // Semua, Mahasiswa, Dosen
            $table->dateTime('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t033_pengumumans');
    }
};