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
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            
            // 1. Cek dulu, kalau kolom 'tahun_ajaran' BELUM ada, baru buat
            if (!Schema::hasColumn('jadwal_pelajarans', 'tahun_ajaran')) {
                $table->string('tahun_ajaran')->nullable()->after('id');
            }

            // 2. Cek semester
            if (!Schema::hasColumn('jadwal_pelajarans', 'semester')) {
                $table->string('semester')->nullable()->after('tahun_ajaran');
            }

            // 3. Cek guru (PENTING: ini yang tadi bikin error controller)
            if (!Schema::hasColumn('jadwal_pelajarans', 'guru')) {
                $table->string('guru')->nullable()->after('mapel');
            }

            // 4. Cek jam_mulai
            if (!Schema::hasColumn('jadwal_pelajarans', 'jam_mulai')) {
                $table->time('jam_mulai')->nullable()->after('hari');
            }

            // 5. Cek jam_selesai
            if (!Schema::hasColumn('jadwal_pelajarans', 'jam_selesai')) {
                $table->time('jam_selesai')->nullable()->after('jam_mulai');
            }

            // 6. Hapus kolom 'jam' lama (hanya jika ada)
            if (Schema::hasColumn('jadwal_pelajarans', 'jam')) {
                $table->dropColumn('jam');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            // Hapus kolom baru (opsional, biarkan kosong tidak apa-apa untuk dev)
        });
    }
};