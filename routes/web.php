<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agen\AgenController;
use App\Http\Controllers\Agen\AgenJITController;
use App\Http\Controllers\Agen\PasswordController;
use App\Http\Controllers\Grosir\GrosirController;
use App\Http\Controllers\Grosir\GrosirKelolaStok;
use App\Http\Controllers\Auth\AgenLoginController;
use App\Http\Controllers\Agen\AgenProdukController;
use App\Http\Controllers\GrosirTransaksiController;
use App\Http\Controllers\Auth\GrosirLoginController;
use App\Http\Controllers\Agen\AgenPembelianController;
use App\Http\Controllers\Agen\AgenTransaksiController;
use App\Http\Controllers\GrosirBeliSekarangController;
use App\Http\Controllers\Agen\AgenDistribusiController;
use App\Http\Controllers\Agen\AgenKelolaStokController;
use App\Http\Controllers\Auth\GrosirRegisterController;
use App\Http\Controllers\Grosir\GrosirProdukController;
use App\Http\Controllers\Grosir\GrosirProfileController;
use App\Http\Controllers\Grosir\GrosirWishlistController;
use App\Http\Controllers\Grosir\GrosirKeranjangController;
use App\Http\Controllers\Grosir\GrosirTentangKamiController;

Route::middleware(['auth', 'x'])->group(function () {
  Route::get('/', function () {
    return view('welcome');
  })->name('home');
});

Route::middleware('guest')->group(function () {
  Route::get('/agen/masuk', [AgenLoginController::class, 'index'])->name('agen.login');
  Route::post('/agen/masuk', [AgenLoginController::class, 'login']);

  Route::get('/grosir/masuk', [GrosirLoginController::class, 'index'])->name('grosir.login');
  Route::get('/grosir/masuk', [GrosirLoginController::class, 'index'])->name('login');
  Route::post('/grosir/masuk', [GrosirLoginController::class, 'login']);

  Route::get('/grosir/daftar', [GrosirRegisterController::class, 'index'])->name('grosir.register');
  Route::post('/grosir/daftar', [GrosirRegisterController::class, 'store']);
});

Route::post('/logout', function () {
  Auth::logout();
  return redirect('/agen/masuk');
})->name('logout');

//  Agen
Route::middleware(['auth', 'agen'])->prefix('agen')->group(function () {

  Route::get('/', [AgenController::class, 'index'])->name('agen.index');
  Route::get('/grosir', [AgenTransaksiController::class, 'show_grosir'])->name('agen.grosir');
  Route::get('/grosir/stok/{id}', [AgenKelolaStokController::class, 'index'])->name('agen.kelola');

  Route::get('/profil', [AgenController::class, 'profil'])->name('agen.profil');
  Route::put('/profil', [AgenController::class, 'profil_update'])->name('agen.profil.update');
  Route::put('/password/update', [PasswordController::class, 'update'])->name('password.update');



  Route::get('/penyimpanan', [AgenProdukController::class, 'index'])->name('agen.produk');

  Route::get('/produk/edit/{produk}', [AgenProdukController::class, 'edit'])->name('agen.produk.edit');
  Route::put('/produk/edit', [AgenProdukController::class, 'update']);
  Route::put('/produk/restock/{id}', [AgenProdukController::class, 'restock'])->name('agen.produk.restock');
  Route::delete('/produk/delete/{id}', [AgenProdukController::class, 'destroy'])->name('agen.produk.delete');

  Route::get('/produk/telur-expired', [AgenTransaksiController::class, 'show_telur_expired'])->name('agen.produk.expired');

  Route::get('/produk/jit', [AgenJITController::class, 'index'])->name('agen.jit.index');
  Route::get('/produk/jit/tambah', [AgenJITController::class, 'create'])->name('agen.jit.create');
  Route::post('/produk/jit/tambah', [AgenJITController::class, 'store'])->name('agen.jit.tambah');
  Route::get('/produk/jit/ubah/{id}', [AgenJITController::class, 'edit'])->name('agen.jit.edit');
  Route::put('/produk/jit/ubah/{id}', [AgenJITController::class, 'update'])->name('agen.jit.update');
  Route::delete('/produk/jit/delete/{id}', [AgenJITController::class, 'destroy'])->name('agen.jit.destroy');


  // Route untuk Pembelian ke Distributor
  Route::get('/transaksi/pembelian', [AgenPembelianController::class, 'index'])->name('agen.transaksi.pembelian');
  Route::get('/transaksi/pembelian/tambah', [AgenPembelianController::class, 'create'])->name('agen.pembelian.tambah');
  Route::post('/transaksi/pembelian/tambah', [AgenPembelianController::class, 'store']);

  // Route untuk Penjualan ke Agen
  Route::get('/transaksi/penjualan', [AgenTransaksiController::class, 'index'])->name('agen.transaksi.penjualan');
  Route::post('/transaksi/status/terima', [AgenTransaksiController::class, 'terima'])->name('agen.transaksi.terima');
  Route::post('/transaksi/status/tolak', [AgenTransaksiController::class, 'tolak'])->name('agen.transaksi.tolak');
  Route::get('/download-bukti/{id}', [AgenTransaksiController::class, 'downloadBukti'])->name('download.bukti');

  Route::get('/transaksi/distribusi', [AgenDistribusiController::class, 'index'])->name('agen.transaksi.distribusi');
  Route::put('/transaksi/distribusi/kirim/', [AgenTransaksiController::class, 'kirim'])->name('agen.transaksi.distribusi.kirim'); // baru

  Route::get('/transaksi/export-pdf', [AgenTransaksiController::class, 'exportPenjualan'])->name('transaksi.exportPenjualan');
  Route::get('/distribusi/export-pdf', [AgenTransaksiController::class, 'exportDistribusi'])->name('distribusi.exportPDF');
  Route::get('/manajemen-jit/export-pdf', [AgenTransaksiController::class, 'exportManajemenJIT'])->name('manajemenJIT.exportPDF');
  Route::get('/grosir/export-pdf', [AgenTransaksiController::class, 'exportGrosir'])->name('grosir.exportPDF');
  Route::get('/produk/export-pdf', [AgenProdukController::class, 'exportProduk'])->name('produk.exportPDF');
  Route::get('/kedaluwarsa/export-pdf', [AgenProdukController::class, 'exportKedaluwarsa'])->name('kedaluwarsa.exportPDF');

  Route::post('/produk/jit/import', [AgenJITController::class, 'importExcel'])->name('produk.jit.import');
});

//  Grosir
Route::middleware(['auth', 'grosir'])->prefix('grosir')->group(function () {

  Route::get('/', [GrosirController::class, 'index'])->name('grosir.index');
  Route::get('/produk', [GrosirProdukController::class, 'index'])->name('grosir.produk.index');
  Route::get('/produk/detail/{nama_produk}', [GrosirProdukController::class, 'show'])->name('grosir.produk.show');
  Route::get('/produk/beli-sekarang/{nama_produk}', [GrosirBeliSekarangController::class, 'index'])->name('grosir.produk.beli-sekarang');
  Route::get('/produk/beli', [GrosirBeliSekarangController::class, 'beli'])->name('grosir.produk.beli');
  Route::get('/tentang', [GrosirTentangKamiController::class, 'index'])->name('grosir.tentang.index');

  Route::post('/transaksi', [GrosirTransaksiController::class, 'store'])->name('grosir.transaksi.store');
  Route::post('/transaksi/checkout', [GrosirTransaksiController::class, 'checkout'])->name('grosir.transaksi.checkout');
  Route::get('/transaksi/ringkasan-pesanan', [GrosirTransaksiController::class, 'ringkasan'])->name('grosir.transaksi.session');
  Route::put('/transaksi/pesanan-diterima/{id}', [GrosirTransaksiController::class, 'pesanan_diterima'])->name('grosir.transaksi.pesanan-diterima');
  Route::get('/transaksi/{id}/nota', [GrosirTransaksiController::class, 'cetakNota'])->name('transaksi.nota');

  Route::get('/pesanan', [GrosirTransaksiController::class, 'index'])->name('grosir.transaksi.index');

  Route::get('/keranjang', [GrosirKeranjangController::class, 'index'])->name('grosir.keranjang');
  Route::post('/keranjang/add', [GrosirKeranjangController::class, 'store'])->name('grosir.keranjang.add');
  Route::delete('/keranjang/destroy', [GrosirKeranjangController::class, 'remove'])->name('grosir.keranjang.destroy');
  Route::delete('/keranjang/hapus', [GrosirKeranjangController::class, 'remove'])->name('grosir.keranjang.hapus');

  Route::get('/kelola', [GrosirKelolaStok::class, 'index'])->name('grosir.kelola');
  Route::get('/kelola/{slug}/update', [GrosirKelolaStok::class, 'show'])->name('grosir.kelola.edit');
  Route::put('/kelola/update', [GrosirKelolaStok::class, 'update'])->name('grosir.kelola.update');


  Route::get('/wishlist', [GrosirWishlistController::class, 'index'])->name('grosir.produk.wishlist');
  Route::post('/grosir/wishlist/add', [GrosirWishlistController::class, 'add'])->name('grosir.produk.wishlist.add');
  Route::delete('/grosir/wishlist/remove', [GrosirWishlistController::class, 'remove'])->name('grosir.produk.wishlist.remove');


  Route::get('/form', [GrosirController::class, 'form'])->name('grosir.form');
  Route::post('/form', [GrosirController::class, 'store']);

  Route::get('/profil', [GrosirProfileController::class, 'index'])->name('grosir.profile');
  Route::put('/profil', [GrosirProfileController::class, 'update'])->name('grosir.profile.update');
});
