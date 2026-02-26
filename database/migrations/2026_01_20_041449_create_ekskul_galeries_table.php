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
    Schema::create('ekskul_galeries', function (Blueprint $table) {
        $table->id();
        
        // PERHATIKAN BAGIAN constrained('eskuls')
        // Pastikan mengarah ke 'eskuls' bukan 'ekskuls'
        $table->foreignId('ekskul_id')->constrained('eskuls')->onDelete('cascade');
        
        $table->string('foto');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekskul_galeries');
    }
};
