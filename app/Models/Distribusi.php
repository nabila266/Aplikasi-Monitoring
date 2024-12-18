<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    use HasFactory;

  protected $fillable = [
    'id_transaksi',
    'no_resi',
    'tanggal_pengiriman',
    'keterangan_pengiriman',
    'status_pengiriman'
  ];

  public function transaksi() {
    return $this->belongsTo(Transaksi::class, 'id_transaksi');
  }
}
