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
    Schema::create('eskuls', function (Blueprint $table) {
        $table->id();
        $table->string('nama_eskul');        // Misal: Pramuka, Paskibra
        $table->string('pembina')->nullable(); // Nama Guru Pembina
        $table->text('deskripsi')->nullable(); // Penjelasan singkat
        $table->string('jadwal')->nullable();  // Misal: Sabtu, 14.00
        $table->string('foto')->nullable();    // Untuk upload foto kegiatan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eskuls');
    }
};
