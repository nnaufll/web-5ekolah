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
        Schema::table('eskuls', function (Blueprint $table) {
            // Tambahkan kolom no_hp
            // nullable() PENTING agar data lama yang belum punya nomor tidak error
            // after('pembina') agar posisinya rapi di sebelah kolom pembina
            $table->string('no_hp', 20)->nullable()->after('pembina');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eskuls', function (Blueprint $table) {
            // Perintah untuk menghapus kolom jika di-rollback
            $table->dropColumn('no_hp');
        });
    }
};