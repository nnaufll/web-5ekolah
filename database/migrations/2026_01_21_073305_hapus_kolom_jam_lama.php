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
            // Hapus kolom 'jam' karena sudah diganti jam_mulai & jam_selesai
            if (Schema::hasColumn('jadwal_pelajarans', 'jam')) {
                $table->dropColumn('jam');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            // Kembalikan jika di-rollback (opsional)
            $table->string('jam')->nullable();
        });
    }
};