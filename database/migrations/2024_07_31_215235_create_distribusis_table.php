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
        Schema::create('distribusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->constrained('transaksis');
            $table->string('no_resi')->nullable();
            $table->date('tanggal_pengiriman')->nullable();
            $table->longText('keterangan_pengiriman')->nullable();
            $table->enum('status_pengiriman', ['gagal', 'diproses', 'dalam perjalanan', 'diterima'])->default('diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusis');
    }
};
