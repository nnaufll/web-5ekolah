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
            // Cek dulu biar aman, kalau belum ada baru dibuat
            if (!Schema::hasColumn('jadwal_pelajarans', 'guru')) {
                // Kita set nullable() karena data lama pasti kosong gurunya
                $table->string('guru')->nullable()->after('nama_kelas');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            $table->dropColumn('guru');
        });
    }
};