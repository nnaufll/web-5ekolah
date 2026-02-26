<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('misis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');              // Contoh: Religius & Berakhlak
            $table->text('deskripsi_singkat');    // Muncul di kartu depan
            $table->text('deskripsi_lengkap');    // Muncul di popup (modal)
            $table->string('gambar')->nullable(); // Foto detail (opsional)
            $table->integer('urutan')->default(0); // Agar bisa diurutkan (1, 2, 3...)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('misis');
    }
};