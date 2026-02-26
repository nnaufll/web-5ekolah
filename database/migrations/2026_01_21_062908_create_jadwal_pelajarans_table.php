<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_jadwal_pelajarans_table.php
public function up()
{
    Schema::create('jadwal_pelajarans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kelas'); // Contoh: 7A, 8B (Bisa diganti relasi ID kalau ada tabel kelas)
        $table->string('hari');       // Senin, Selasa, dst
        $table->string('mapel');      // Matematika
        $table->string('jam');        // 07:00 - 08:30
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajarans');
    }
};
