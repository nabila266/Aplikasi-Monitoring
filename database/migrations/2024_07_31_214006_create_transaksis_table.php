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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_grosir')->constrained('grosirs');
            $table->foreignId('id_produk')->constrained('produks');
            $table->string('no_faktur');
            $table->integer('qty');
            $table->integer('total_harga');
            $table->string('bukti_pembayaran');
            $table->enum('jenis_pengiriman', ['darurat', 'reguler']);
            $table->enum('status', ['pending', 'berhasil', 'gagal'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
