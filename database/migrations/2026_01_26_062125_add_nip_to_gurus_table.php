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
        Schema::table('gurus', function (Blueprint $table) {
            // Menambahkan kolom nip setelah kolom nama
            // Kita buat nullable() agar tidak error jika ada data lama yang nip-nya kosong
            $table->string('nip')->nullable()->after('nama'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn('nip');
        });
    }
};