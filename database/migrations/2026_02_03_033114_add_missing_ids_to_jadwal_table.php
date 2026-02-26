<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            // Tambah mapel_id jika belum ada
            if (!Schema::hasColumn('jadwal_pelajarans', 'mapel_id')) {
                $table->unsignedBigInteger('mapel_id')->nullable()->after('mapel');
            }
            
            // Tambah guru_id jika belum ada
            if (!Schema::hasColumn('jadwal_pelajarans', 'guru_id')) {
                $table->unsignedBigInteger('guru_id')->nullable()->after('guru');
            }
        });
    }

    public function down()
    {
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            $table->dropColumn(['mapel_id', 'guru_id']);
        });
    }
};