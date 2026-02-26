<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah')->nullable();
            $table->string('akreditasi')->nullable(); // Kolom Baru
            $table->string('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('nama_kepsek')->nullable();
            $table->string('foto_kepsek')->nullable();
            $table->text('sambutan_kepsek')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('link_youtube')->nullable(); // Kolom Baru (Video Profil)
            $table->integer('jml_guru')->nullable();
            $table->integer('jml_siswa')->nullable();
            $table->integer('jml_staf')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_sekolahs');
    }
};