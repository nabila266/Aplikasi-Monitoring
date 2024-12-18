<?php

namespace App\Http\Controllers;

use App\Models\Grosir;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\Distribusi;
use App\Models\KelolaStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrosirTransaksiController extends Controller
{
  public function index()
  {
    $user = auth()->user();
    $grosir = Grosir::where('id_user', $user->id)->first();
    $transaksi = Transaksi::where('id_grosir', $grosir->id)
      ->with(['produk', 'grosir'])
      ->orderBy('no_faktur', 'desc')
      ->get()
      ->groupBy('no_faktur');

    return view('grosir.pesanan', compact('transaksi'));
  }

  public function store(Request $request)
  {
    // Validasi input
    $validated = $request->validate([
      'id_grosir' => 'required|exists:grosirs,id',
      'id_produk' => 'required|exists:produks,id',
      'qty' => 'required|numeric|min:1',
      'bukti_pembayaran' => 'required|file|mimes:jpeg,png,pdf|max:2048',
      'jenis_pengiriman' => 'required|in:reguler,darurat',
    ], [
      'id_grosir.required' => 'Grosir harus dipilih.',
      'id_grosir.exists' => 'Grosir yang dipilih tidak valid.',
      'id_produk.required' => 'Produk harus dipilih.',
      'id_produk.exists' => 'Produk yang dipilih tidak valid.',
      'qty.required' => 'Jumlah (qty) wajib diisi.',
      'qty.numeric' => 'Jumlah (qty) harus berupa angka.',
      'qty.min' => 'Jumlah (qty) minimal adalah 1.',
      'bukti_pembayaran.required' => 'Bukti pembayaran wajib diunggah.',
      'bukti_pembayaran.file' => 'File bukti pembayaran tidak valid.',
      'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan format: jpeg, png, atau pdf.',
      'bukti_pembayaran.max' => 'Ukuran file bukti pembayaran tidak boleh lebih dari 2MB.',
      'jenis_pengiriman.required' => 'Jenis pengiriman wajib dipilih.',
      'jenis_pengiriman.in' => 'Jenis pengiriman harus salah satu dari: reguler, darurat.',
    ]);

    // Menyimpan file ke dalam folder public/img/upload/bukti_pembayaran
    if ($request->hasFile('bukti_pembayaran')) {
      $file = $request->file('bukti_pembayaran');
      $filename = time() . '_' . $file->getClientOriginalName(); // Membuat nama file unik
      $file->move(public_path('upload/bukti_pembayaran'), $filename); // Menyimpan file
    }

    // Generate nomor faktur otomatis
    $date = date('Ymd'); // Tanggal saat ini dalam format YYYYMMDD
    $lastInvoice = Transaksi::whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->first();
    $nextInvoiceNumber = $lastInvoice ? ((int)substr($lastInvoice->no_faktur, -4)) + 1 : 1;
    $noFaktur = 'INV-' . $date . '-' . str_pad($nextInvoiceNumber, 4, '0', STR_PAD_LEFT);

    // Hitung ongkos kirim
    $ongkosKirim = ($request->input('jenis_pengiriman') == 'darurat') ? 50000 : 20000;

    // Ambil harga produk
    $hargaProduk = Produk::find($request->input('id_produk'))->harga_produk;

    // Hitung total harga
    $totalHarga = $ongkosKirim + ($validated['qty'] * $hargaProduk);

    // Menyimpan data transaksi ke database
    Transaksi::create([
      'id_grosir' => $validated['id_grosir'],
      'id_produk' => $validated['id_produk'],
      'no_faktur' => $noFaktur, // Nomor faktur yang dihasilkan otomatis
      'qty' => $validated['qty'],
      'total_harga' => $totalHarga,
      'bukti_pembayaran' => $filename, // Simpan nama file yang sudah diupload
      'jenis_pengiriman' => $validated['jenis_pengiriman'],
      'status' => 'pending', // Status default
    ]);

    return redirect()->route('grosir.transaksi.session')->with('success', 'Berhasil melakukan transaksi.');
  }

  public function checkout(Request $request)
  {
    // Validasi input
    $validated = $request->validate([
      'id_grosir' => 'required|exists:grosirs,id',
      'id_produk.*' => 'required|exists:produks,id',
      'qty.*' => 'required|numeric|min:1',
      'bukti_pembayaran' => 'required|file|mimes:jpeg,png,pdf|max:2048',
      'jenis_pengiriman' => 'required|in:reguler,darurat',
    ], [
      'id_grosir.required' => 'Grosir harus dipilih.',
      'id_grosir.exists' => 'Grosir yang dipilih tidak valid.',
      'id_produk.*.required' => 'Produk harus dipilih.',
      'id_produk.*.exists' => 'Produk yang dipilih tidak valid.',
      'qty.*.required' => 'Jumlah (qty) wajib diisi.',
      'qty.*.numeric' => 'Jumlah (qty) harus berupa angka.',
      'qty.*.min' => 'Jumlah (qty) minimal adalah 1.',
      'bukti_pembayaran.required' => 'Bukti pembayaran wajib diunggah.',
      'bukti_pembayaran.file' => 'File bukti pembayaran tidak valid.',
      'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan format: jpeg, png, atau pdf.',
      'bukti_pembayaran.max' => 'Ukuran file bukti pembayaran tidak boleh lebih dari 2MB.',
      'jenis_pengiriman.required' => 'Jenis pengiriman wajib dipilih.',
      'jenis_pengiriman.in' => 'Jenis pengiriman harus salah satu dari: reguler, darurat.',
    ]);

    // Menyimpan file ke dalam folder public/upload/bukti_pembayaran
    $filename = null;
    if ($request->hasFile('bukti_pembayaran')) {
      $file = $request->file('bukti_pembayaran');
      $filename = time() . '_' . $file->getClientOriginalName(); // Membuat nama file unik
      $file->move(public_path('upload/bukti_pembayaran'), $filename); // Menyimpan file
    }

    // Generate nomor faktur otomatis
    $date = date('Ymd'); // Tanggal saat ini dalam format YYYYMMDD
    $lastInvoice = Transaksi::whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->first();
    $nextInvoiceNumber = $lastInvoice ? ((int)substr($lastInvoice->no_faktur, -4)) + 1 : 1;
    $noFaktur = 'INV-' . $date . '-' . str_pad($nextInvoiceNumber, 4, '0', STR_PAD_LEFT);

    // Hitung ongkos kirim
    $ongkosKirim = ($request->input('jenis_pengiriman') == 'darurat') ? 50000 : 20000;

    // Ambil harga produk
    $produkIds = $request->input('id_produk');
    $qtys = $request->input('qty');

    $totalHargaSemuaProduk = 0; // Inisialisasi total harga semua produk tanpa ongkos kirim

    foreach ($produkIds as $index => $produkId) {
      $hargaProduk = Produk::find($produkId)->harga_produk;
      $qty = $qtys[$index];
      $totalHargaProduk = $qty * $hargaProduk;

      // Tambahkan total harga produk ini ke total semua produk
      $totalHargaSemuaProduk += $totalHargaProduk;

      // Menyimpan data transaksi ke database
      Transaksi::create([
        'id_grosir' => $validated['id_grosir'],
        'id_produk' => $produkId,
        'no_faktur' => $noFaktur,
        'qty' => $qty,
        'total_harga' => $totalHargaProduk, // Hanya total harga produk, tanpa ongkos kirim
        'bukti_pembayaran' => $filename, // Simpan nama file yang sudah diupload
        'jenis_pengiriman' => $validated['jenis_pengiriman'],
        'status' => 'pending', // Status default
      ]);

      // Hapus item dari keranjang
      Keranjang::where('id_grosir', $validated['id_grosir'])
        ->where('id_produk', $produkId)
        ->delete();
    }

    // Setelah perulangan selesai, tambahkan ongkos kirim sekali saja ke total keseluruhan
    $totalHargaSemuaProduk += $ongkosKirim;

    session()->put('no_faktur', $noFaktur);

    return redirect()->route('grosir.transaksi.session')->with('success', 'Berhasil melakukan transaksi.');
  }

  public function ringkasan()
  {
    $user = auth()->user();
    $grosir = Grosir::where('id_user', $user->id)->first();

    // Ambil ID transaksi terbaru dari sesi
    $no_faktur = Transaksi::where('id_grosir', $grosir->id)->latest()->first()->no_faktur;

    // Ambil transaksi berdasarkan ID yang disimpan di sesi
    $transaksis = Transaksi::where('no_faktur', $no_faktur)
      ->with(['grosir', 'produk'])
      ->latest()->get();

    return view('grosir.transaction.ringkasan', compact('grosir', 'transaksis'));
  }

  public function pesanan_diterima($id)
  {
      $user = auth()->user();
      $grosir = Grosir::where('id_user', $user->id)->first();
      $distribusi = Distribusi::find($id);
      $transaksi = Transaksi::find($distribusi->id_transaksi);
      $noFaktur = $transaksi->no_faktur;

      // Ambil semua transaksi dengan no_faktur yang sama
      $transaksiAll = Transaksi::where('no_faktur', $noFaktur)->get();

      // Ambil semua distribusi yang terkait dengan transaksi tersebut
      $distribusiAll = Distribusi::whereIn('id_transaksi', $transaksiAll->pluck('id'))->get();

      // Perbarui status pengiriman semua distribusi menjadi 'diterima'
      foreach ($distribusiAll as $distribusi) {
          $distribusi->status_pengiriman = 'diterima';
          $distribusi->save();
      }

      // Perbarui stok produk
      foreach ($transaksiAll as $transaksi) {
          $kelolaStok = KelolaStok::where('id_produk', $transaksi->id_produk)->first();

          if ($kelolaStok) {
              // Update stok produk jika sudah ada
              $kelolaStok->stok_produk = $kelolaStok->stok_produk + $transaksi->qty;
              $kelolaStok->save();
          } else {
              // Create stok produk jika belum ada
              KelolaStok::create([
                  'id_grosir' => $grosir->id,
                  'id_produk' => $transaksi->id_produk,
                  'stok_produk' => $transaksi->qty,
              ]);
          }
      }

      return redirect()->route('grosir.transaksi.index')->with('success', 'Pesanan Anda telah diterima. Terima kasih atas kepercayaan Anda berbelanja bersama kami.');
  }

  public function cetakNota($id)
  {
    // Temukan transaksi berdasarkan ID dan ambil nomor faktur
    $transaksi = Transaksi::with(['grosir', 'produk'])->find($id);

    // Ambil semua transaksi yang memiliki nomor faktur yang sama
    $dataFaktur = Transaksi::where('no_faktur', $transaksi->no_faktur)
      ->with(['grosir', 'produk'])
      ->get();

    // Cari informasi distribusi jika ada (mengambil dari transaksi pertama)
    $distribusi = Distribusi::where('id_transaksi', $transaksi->id)->first();

    // Kirimkan $dataFaktur ke view dan distribusi
    return view('grosir.nota.nota', compact('dataFaktur', 'distribusi'));
  }
}