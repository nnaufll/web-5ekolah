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
    Schema::table('galeris', function (Blueprint $table) {
        $table->string('link_youtube')->nullable()->after('foto');
        // Kita buat nullable, karena kalau upload foto, link ini kosong
        // Dan kolom 'foto' juga harus diubah jadi nullable jika belum.
        $table->string('foto')->nullable()->change(); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            //
        });
    }
};
