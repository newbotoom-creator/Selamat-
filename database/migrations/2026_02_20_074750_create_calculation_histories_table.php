<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('calculation_histories', function (Blueprint $table) {
        $table->id();
        $table->string('formula'); // Contoh: "10 + 5"
        $table->float('result');   // Hasil: 15
        $table->string('type');    // Tipe: "Aritmatika"
        $table->timestamps();      // Ini penting untuk diagram bulanan (created_at)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculation_histories');
    }
};
