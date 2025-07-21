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
        Schema::create('peminjam_barangs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('peminjam_id')->constrained()->cascadeOnDelete();
        $table->foreignId('barang_id')->constrained()->cascadeOnDelete();
        $table->integer('jumlah');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_kembali')->nullable();
        $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjam_barangs');
    }
};
