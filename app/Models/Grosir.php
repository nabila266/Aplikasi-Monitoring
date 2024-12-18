<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grosir extends Model
{
    use HasFactory;

    protected $fillable = [
      'id_user',
      'nama_grosir',
      'nomor_telefon_grosir',
      'alamat_grosir',
      'foto_grosir',
    ];

  public function user()
  {
    return $this->belongsTo(User::class, 'id_user');
  }
}
