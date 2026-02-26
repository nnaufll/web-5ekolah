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
    Schema::create('spmb_links', function (Blueprint $table) {
        $table->id();
        $table->string('judul');      // Misal: Jalur Negeri, Jalur Swasta
        $table->string('url');        // Link tujuannya
        $table->string('icon')->nullable(); // Class icon bootstrap (misal: bi-google)
        $table->boolean('is_active')->default(true); // Untuk menyembunyikan link jika pendaftaran tutup
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmb_links');
    }
};
