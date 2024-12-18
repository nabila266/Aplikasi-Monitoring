<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaStok extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_grosir',
        'id_produk',
        'stok_produk',
    ];

    public function grosir()
    {
        return $this->belongsTo(Grosir::class, 'id_grosir');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
