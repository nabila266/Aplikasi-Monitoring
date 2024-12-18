<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

  protected $fillable = [
    'id_grosir',
    'id_produk',
  ];
  // Wishlist.php
public function product()
{
    return $this->belongsTo(Produk::class, 'id_produk');
}

}
