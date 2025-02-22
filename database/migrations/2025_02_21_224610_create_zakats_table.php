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
        Schema::create('zakats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemberi');
            $table->foreignId('lingkungan_id')->constrained('lingkungans')->onDelete('cascade');
            $table->foreignId('jenis_id')->constrained('jenis_zakats')->onDelete('cascade');
            $table->decimal('jumlah');
            $table->date('tanggal');
            $table->year('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zakats');
    }
};
