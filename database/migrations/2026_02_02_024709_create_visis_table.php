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
    Schema::create('visis', function (Blueprint $table) {
        $table->id();
        $table->integer('urutan')->default(1);
        $table->string('judul');
        $table->text('deskripsi_singkat')->nullable();
        $table->longText('deskripsi_lengkap')->nullable();
        $table->string('gambar')->nullable(); // Untuk foto background
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visis');
    }
};
