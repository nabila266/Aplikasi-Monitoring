<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('telur_expireds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->constrained('produks');
            $table->integer('stok_masuk')->default(0);
            $table->dateTime('tanggal_restok');
            $table->dateTime('tanggal_kedaluwarsa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telur_expireds');
    }
};
