<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use App\Models\Distribusi;
use App\Models\Grosir;
use App\Models\PerhitunganJIT;
use App\Models\Produk;
use App\Models\TelurExpired;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgenTransaksiController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // Mengambil data transaksi yang dikelompokkan berdasarkan no_faktur
    $transaksiGrouped = Transaksi::with(['grosir', 'produk'])
      ->select('no_faktur', 'jenis_pengiriman', 'status')
      ->selectRaw('SUM(qty) as total_qty, SUM(total_harga) as total_harga')
      ->groupBy('no_faktur', 'jenis_pengiriman', 'status')
      ->latest()
      ->get();

    return view('agen.transaksi.penjualan', compact('transaksiGrouped'));
  }


  public function show_telur_expired()
  {
    $telur_expired = TelurExpired::with('produk')->latest()->get();

    return view('agen.transaksi.telur-expired', compact('telur_expired'));
  }

  public function show_grosir()
  {
    $grosirs = Grosir::with('user')->get();

    return view('agen.transaksi.grosir', compact('grosirs'));
  }

  public function downloadBukti($id)
  {
    $transaction = Transaksi::where('no_faktur', $id)->first();
    $urlToFile = asset('upload/bukti_pembayaran/' . $transaction->bukti_pembayaran);

    return redirect($urlToFile);
  }

  public function terima(Request $request)
  {
    // Ambil semua transaksi berdasarkan no_faktur
    $transaksis = Transaksi::where('no_faktur', $request->no_faktur)->get();

    if ($transaksis->isEmpty()) {
      return redirect()->back()->with('error', 'Maaf, transaksi dengan nomor faktur tersebut tidak dapat ditemukan.');
    }

    // Loop melalui setiap transaksi terkait no_faktur
    foreach ($transaksis as $transaksi) {
      // Ubah status transaksi menjadi 'berhasil'
      $transaksi->status = 'berhasil';
      $transaksi->save();

      // Buat distribusi untuk setiap transaksi
      $distribusi = Distribusi::create([
        'id_transaksi' => $transaksi->id,
      ]);

      // Kurangi stok produk sesuai dengan qty transaksi
      $produk = Produk::find($transaksi->id_produk);
      if ($produk) {
        $stokBaru = $produk->stok_produk - $transaksi->qty;
        $produk->stok_produk = $stokBaru;
        $produk->stok_realtime_produk = $stokBaru;
        $produk->save();
      }
    }

    return redirect()->back()->with('success', 'Semua transaksi dalam nomor faktur telah berhasil diproses.');
  }

  public function tolak(Request $request)
  {
    // Ambil semua transaksi berdasarkan no_faktur
    $transaksis = Transaksi::where('no_faktur', $request->no_faktur)->get();

    if ($transaksis->isEmpty()) {
      return redirect()->back()->with('error', 'Maaf, transaksi dengan nomor faktur tersebut tidak dapat ditemukan.');
    }

    // Loop melalui setiap transaksi terkait no_faktur
    foreach ($transaksis as $transaksi) {
      // Ubah status transaksi menjadi 'gagal'
      $transaksi->status = 'gagal';
      $transaksi->save();
    }

    return redirect()->back()->with('success', 'Semua transaksi dalam nomor faktur telah berhasil ditolak.');
  }

  public function kirim(Request $request)
  {
    // Validasi input request
    $validated = $request->validate([
      'no_resi' => 'required|string|max:255',
      'keterangan_pengiriman' => 'nullable|string|max:1000'
    ], [
      'no_resi.required' => 'Nomor resi pengiriman wajib diisi.',
      'no_resi.string' => 'Nomor resi harus berupa teks.',
      'no_resi.max' => 'Nomor resi tidak boleh lebih dari 255 karakter.',
      'keterangan_pengiriman.string' => 'Keterangan pengiriman harus berupa teks.',
      'keterangan_pengiriman.max' => 'Keterangan pengiriman tidak boleh lebih dari 1000 karakter.',
    ]);
    
    // Ambil transaksi yang memiliki no_faktur yang sama
    $transaksis = Transaksi::where('no_faktur', $request->no_faktur)->get();
    
    // Periksa apakah ada transaksi dengan no_faktur yang diberikan
    if ($transaksis->isEmpty()) {
      return redirect()->back()->with('error', 'Tidak ada transaksi ditemukan dengan nomor faktur tersebut.');
    }

    // Loop melalui transaksi dan update distribusi terkait
    foreach ($transaksis as $transaksi) {
      $distribusi = Distribusi::where('id_transaksi', $transaksi->id)->first();

      if ($distribusi) {
        // Update distribusi dengan nomor resi dan status pengiriman
        $distribusi->no_resi = $validated['no_resi'];
        $distribusi->tanggal_pengiriman = now();
        $distribusi->keterangan_pengiriman = $validated['keterangan_pengiriman'];
        $distribusi->status_pengiriman = 'dalam perjalanan';
        $distribusi->save();
      }
    }

    return redirect()->back()->with('success', 'Produk telah berhasil dikirim.');
  }

  public function exportPenjualan(Request $request)
  {
    // Mengambil data berdasarkan filter waktu
    $startDate = $request->start_date;
    $endDate = $request->end_date;
    $transaksis = Transaksi::whereBetween('created_at', [$startDate, $endDate])->get();

    // Membuat PDF
    $pdf = PDF::loadView('agen.pdf.transaksi', compact('transaksis'));
    return $pdf->download('laporan-transaksi.pdf');
  }

  public function exportDistribusi(Request $request)
  {
    $distribusis = Distribusi::whereBetween('created_at', [$request->start_date, $request->end_date])->get();

    $pdf = PDF::loadView('agen.pdf.distribusi', compact('distribusis'));
    return $pdf->download('laporan-distribusi.pdf');
  }

  public function exportManajemenJIT(Request $request)
  {
    // Ambil data JIT berdasarkan rentang tanggal yang dipilih
    $perhitunganJIT = PerhitunganJIT::with('jit')
      ->get();

    // Load view untuk PDF dan masukkan data perhitungan JIT
    $pdf = PDF::loadView('agen.pdf.manajemen_jit', compact('perhitunganJIT'));

    // Download file PDF dengan nama yang mencakup rentang tanggal
    return $pdf->download('laporan-manajemen-jit.pdf');
  }

  public function exportGrosir()
  {

    $grosirs = Grosir::all();

    // Load view untuk PDF dan masukkan data grosir
    $pdf = PDF::loadView('agen.pdf.grosir', compact('grosirs'));

    // Download file PDF
    return $pdf->download('daftar-grosir.pdf');
  }

  public function exportKedaluwarsa(Request $request)
  {
    // Ambil data produk yang kedaluwarsa
    $telur_expired = TelurExpired::with('produk')->get();

    // Load view untuk PDF dan masukkan data produk yang kedaluwarsa
    $pdf = PDF::loadView('agen.pdf.kedaluwarsa_produk', compact('telur_expired'));

    // Download file PDF
    return $pdf->download('laporan-kedaluwarsa-produk.pdf');
  }
}