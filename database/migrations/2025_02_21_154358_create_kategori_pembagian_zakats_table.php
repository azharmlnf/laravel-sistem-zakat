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
        Schema::create('kategori_pembagian_zakats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_penerimas')->onDelete('cascade');
            $table->integer('jumlah_beras');
            $table->integer('jumlah_uang');
            $table->year('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_pembagian_zakats');
    }
};
