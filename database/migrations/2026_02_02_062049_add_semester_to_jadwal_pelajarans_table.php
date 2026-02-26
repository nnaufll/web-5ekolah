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
        $table->string('tahun_ajaran')->nullable(); // Contoh: "2024/2025"
        $table->string('semester')->nullable();     // Contoh: "Ganjil" atau "Genap"
    });
}

public function down()
{
    Schema::table('jadwal_pelajarans', function (Blueprint $table) {
        $table->dropColumn(['tahun_ajaran', 'semester']);
    });
}
};
