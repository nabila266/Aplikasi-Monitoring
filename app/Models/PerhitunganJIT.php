<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerhitunganJIT extends Model
{
    use HasFactory;

  protected $table = 'perhitungan_jit';

  protected $fillable = [
    'id_jit',
    'jumlah_pengiriman_optimal',
    'kuantitas_pesanan_optimal',
    'kuantitas_pengiriman_optimal',
    'frekuensi_pesanan',
    'total_biaya_persediaan'
  ];

  public function jit()
  {
    return $this->belongsTo(JIT::class, 'id_jit');
  }
}
