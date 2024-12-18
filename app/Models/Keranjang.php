<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

  protected $fillable = [
    'id_grosir',
    'id_produk',
    'qty',
  ];

  public function produk()
  {
    return $this->belongsTo(Produk::class, 'id_produk');
  }
}
