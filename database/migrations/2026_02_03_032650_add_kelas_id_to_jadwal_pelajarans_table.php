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
        // Menambahkan kolom kelas_id setelah kolom hari (atau sesuaikan posisinya)
        $table->unsignedBigInteger('kelas_id')->nullable()->after('hari');

        // Opsional: Tambahkan foreign key jika tabel 'kelas' sudah ada
        // $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('jadwal_pelajarans', function (Blueprint $table) {
        $table->dropColumn('kelas_id');
    });
}
};
