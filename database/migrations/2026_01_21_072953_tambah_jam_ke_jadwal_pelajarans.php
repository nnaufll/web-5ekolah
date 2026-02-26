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
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            // Kita tambahkan kolom jam_mulai & jam_selesai
            // Gunakan nullable() agar data lama tidak error saat migration jalan
            
            if (!Schema::hasColumn('jadwal_pelajarans', 'jam_mulai')) {
                $table->time('jam_mulai')->nullable()->after('hari');
            }
            
            if (!Schema::hasColumn('jadwal_pelajarans', 'jam_selesai')) {
                $table->time('jam_selesai')->nullable()->after('jam_mulai');
            }

            // Cek juga kolom nama_kelas (jaga-jaga kalau ternyata belum ada)
            if (!Schema::hasColumn('jadwal_pelajarans', 'nama_kelas')) {
                $table->string('nama_kelas')->nullable()->after('mapel');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            $table->dropColumn(['jam_mulai', 'jam_selesai', 'nama_kelas']);
        });
    }
};