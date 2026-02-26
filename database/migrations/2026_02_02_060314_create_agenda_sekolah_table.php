<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('agenda_sekolah', function (Blueprint $table) {
        $table->id();
        $table->string('judul'); // Contoh: "Penilaian Tengah Semester (PTS)"
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->enum('tipe', ['kbm_biasa', 'ujian', 'libur', 'event'])->default('event');
        $table->string('tahun_ajaran'); // Contoh: "2024/2025"
        $table->string('semester'); // "Ganjil" atau "Genap"
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_sekolah');
    }
};
