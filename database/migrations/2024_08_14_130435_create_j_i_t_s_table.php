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
        Schema::create('jit', function (Blueprint $table) {
          $table->id();
          $table->integer('kuantitas_pemesanan')->default(0);
          $table->integer('rata_rata_target_persediaan')->default(0);
          $table->integer('biaya_pemesanan_per_unit')->default(0);
          $table->integer('jumlah_kebutuhan_bahan_baku_tahunan')->default(0);
          $table->integer('biaya_penyimpanan_per_unit')->default(0);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('j_i_t_s');
    }
};
