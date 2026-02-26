<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menggunakan nama tabel yang benar: profil_sekolahs
        Schema::table('profil_sekolahs', function (Blueprint $table) {
            $table->string('header_file')->nullable()->after('id'); 
            $table->string('header_type')->default('image')->after('header_file');
        });
    }

    public function down(): void
    {
        Schema::table('profil_sekolahs', function (Blueprint $table) {
            $table->dropColumn(['header_file', 'header_type']);
        });
    }
};