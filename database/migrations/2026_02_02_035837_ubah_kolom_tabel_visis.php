<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visis', function (Blueprint $table) {
            // 1. Ganti nama kolom 'judul' menjadi 'isi'
            $table->renameColumn('judul', 'isi');

            // 2. Ganti nama kolom 'deskripsi_singkat' menjadi 'keterangan'
            $table->renameColumn('deskripsi_singkat', 'keterangan');

            // 3. Hapus kolom yang tidak dipakai lagi (Opsional, biar bersih)
            $table->dropColumn(['urutan', 'deskripsi_lengkap']);
        });
    }

    public function down(): void
    {
        Schema::table('visis', function (Blueprint $table) {
            // Kembalikan seperti semula jika di-rollback
            $table->renameColumn('isi', 'judul');
            $table->renameColumn('keterangan', 'deskripsi_singkat');
            $table->integer('urutan')->default(1);
            $table->longText('deskripsi_lengkap')->nullable();
        });
    }
};