<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agen extends Model
{
    use HasFactory;

  protected $fillable = [
    'id_user',
    'nama_agen',
    'nomor_telefon_agen',
    'alamat_agen',
    'foto_agen',
  ];

  public function user() {
    return $this->belongsTo(User::class, 'id_user');
  }
}
