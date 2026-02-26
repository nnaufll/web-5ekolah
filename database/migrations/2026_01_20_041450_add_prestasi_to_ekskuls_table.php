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
    // UBAH 'ekskuls' MENJADI 'eskuls'
    Schema::table('eskuls', function (Blueprint $table) {
        $table->text('prestasi')->nullable()->after('deskripsi');
    });
}

public function down()
{
    // UBAH 'ekskuls' MENJADI 'eskuls'
    Schema::table('eskuls', function (Blueprint $table) {
        $table->dropColumn('prestasi');
    });
}
};
