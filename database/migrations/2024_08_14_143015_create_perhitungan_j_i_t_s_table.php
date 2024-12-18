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
        Schema::create('perhitungan_jit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jit')->constrained('jit');
            $table->decimal('jumlah_pengiriman_optimal', 15, 2)->default(0);
            $table->decimal('kuantitas_pesanan_optimal', 15, 2)->default(0);
            $table->decimal('kuantitas_pengiriman_optimal', 15, 2)->default(0);
            $table->decimal('frekuensi_pesanan', 15, 2)->default(0);
            $table->decimal('total_biaya_persediaan', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perhitungan_j_i_t_s');
    }
};
