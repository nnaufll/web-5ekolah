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
    Schema::table('eskuls', function (Blueprint $table) {
        // Kita buat nullable dulu agar tidak error saat ditambahkan ke data lama
        $table->string('slug')->nullable()->after('nama_eskul'); 
    });
}

public function down()
{
    Schema::table('eskuls', function (Blueprint $table) {
        $table->dropColumn('slug');
    });
}
};
