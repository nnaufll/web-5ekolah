<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        // database/migrations/xxxx_create_agendas_table.php
public function up()
{
    Schema::create('agendas', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Contoh: "UAS Semester 1"
        $table->date('start');   // Tgl Mulai (misal tgl 1)
        $table->date('end');     // Tgl Selesai (misal tgl 5)
        $table->string('kategori')->default('kbm'); // kbm, libur, ujian
        $table->string('warna')->default('#3788d8'); // Warna event di kalender
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
