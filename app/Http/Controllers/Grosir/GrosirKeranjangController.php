<?php

namespace App\Http\Controllers\Grosir;

use App\Http\Controllers\Controller;
use App\Models\Grosir;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrosirKeranjangController extends Controller
{
  public function index()
  {
    $grosir = Grosir::where('id_user', Auth::id())->first();
    $keranjangs = Keranjang::where('id_grosir', $grosir->id)->with('produk')->get();

    $subtotal = 0;

    foreach ($keranjangs as $keranjang) {
      $subtotal += $keranjang->qty * $keranjang->produk->harga_produk;
    }

    return view('grosir.keranjang', compact('grosir', 'keranjangs', 'subtotal'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'qty' => 'required|numeric|min:1',
    ], [
      'qty.required' => 'Jumlah tidak boleh kosong',
      'qty.min' => 'Jumlah tidak boleh kurang dari 1',
    ]);

    $user = Auth::user();
    $grosir = Grosir::where('id_user', $user->id)->first();

    if (!$grosir) {
      return redirect()->back()->with(['error' => 'Grosir tidak ditemukan.']);
    }

    $id_produk = $request->input('id_produk');
    $qtyToAdd = $request->input('qty');

    // Cek apakah produk ada dan ambil stoknya
    $produk = Produk::find($id_produk);
    if (!$produk) {
      return redirect()->back()->with(['error' => 'Produk tidak ditemukan.']);
    }

    // Cek apakah qty melebihi stok yang tersedia
    if ($qtyToAdd > $produk->stok_produk) {
      return redirect()->back()->with(['error' => 'Jumlah yang dimasukkan melebihi stok produk yang tersedia.']);
    }

    // Cek apakah produk sudah ada di keranjang
    $keranjang = Keranjang::where('id_grosir', $grosir->id)
      ->where('id_produk', $id_produk)
      ->first();

    if ($keranjang) {
      // Cek apakah total qty setelah penambahan akan melebihi stok
      if (($keranjang->qty + $qtyToAdd) > $produk->stok_produk) {
        return redirect()->back()->with(['error' => 'Jumlah total di keranjang melebihi stok produk yang tersedia.']);
      }
      $keranjang->qty += $qtyToAdd;
      $keranjang->save();
    } else {
      Keranjang::create([
        'id_grosir' => $grosir->id,
        'id_produk' => $id_produk,
        'qty'       => $qtyToAdd,
      ]);
    }

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
  }

  public function remove(Request $request)
  {
    $id = $request->id;
    $keranjang = Keranjang::find($id);

    if (!$keranjang) {
      return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang.');
    }

    $keranjang->delete();

    return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
  }
}
