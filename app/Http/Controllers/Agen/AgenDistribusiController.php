<?php

namespace App\Http\Controllers\Agen;

use App\Models\Distribusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AgenDistribusiController extends Controller
{
  public function index()
  {
    // Mengelompokkan distribusi berdasarkan no_faktur dari tabel transaksi
    $distribusis = Distribusi::select(
      'transaksis.no_faktur',
      \DB::raw('MAX(distribusis.no_resi) as no_resi'),
      \DB::raw('MAX(distribusis.tanggal_pengiriman) as tanggal_pengiriman'),
      \DB::raw('MAX(distribusis.status_pengiriman) as status_pengiriman'),
      \DB::raw('MAX(distribusis.keterangan_pengiriman) as keterangan_pengiriman')
    )
      ->join('transaksis', 'transaksis.id', '=', 'distribusis.id_transaksi') // Join ke tabel transaksi
      ->groupBy('transaksis.no_faktur')
      ->orderBy('distribusis.created_at', 'desc')
      ->get();

    return view('agen.transaksi.distribusi', compact('distribusis'));
  }
}
