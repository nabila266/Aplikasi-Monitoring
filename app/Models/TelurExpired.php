<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelurExpired extends Model
{
    use HasFactory;

    protected $fillable = [
      'id_produk',
      'stok_masuk',
      'tanggal_restok',
      'tanggal_kedaluwarsa'
    ];

    public function produk()
    {
      return $this->belongsTo(Produk::class, 'id_produk');
    }
}
