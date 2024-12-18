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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_agen')->constrained('agens');
            $table->string('nama_produk')->unique();
            $table->longText('deskripsi_produk');
            $table->integer('stok_produk')->default(0);
            $table->integer('stok_realtime_produk')->default(0);
            $table->integer('harga_produk')->default(0);
            $table->string('foto_produk')->nullable();
            $table->enum('status', ['tersedia', 'tidak tersedia'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
