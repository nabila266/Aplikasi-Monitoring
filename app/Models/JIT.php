<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JIT extends Model
{
    use HasFactory;

    protected $table = 'jit';

  protected $fillable = [
    'kuantitas_pemesanan',
    'rata_rata_target_persediaan',
    'biaya_pemesanan_per_unit',
    'jumlah_kebutuhan_bahan_baku_tahunan',
    'biaya_penyimpanan_per_unit',
  ];
}
