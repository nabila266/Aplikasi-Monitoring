<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use App\Imports\JITImport;
use App\Models\Agen;
use App\Models\Produk;
use App\Models\TelurExpired;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AgenProdukController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $produks = Produk::all();

    return view('agen.produk', compact('produks'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('agen.produk.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->merge(['nama_produk' => strtolower($request->nama_produk)]);

    $validatedData = $request->validate([
      'nama_produk' => 'required|string|unique:produks|max:255',
      'deskripsi_produk' => 'required|string',
      'harga_produk' => 'required|numeric|min:0',
      'stok_produk' => 'required|integer|min:0',
      'rop_produk' => 'required|integer|min:0',
      'lead_time_produk' => 'required|integer|min:0',
      'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB untuk gambar,
      'tanggal_kedaluwarsa' => 'required|integer|min:0',
    ], [
      'nama_produk.required' => 'Nama produk harus diisi.',
      'nama_produk.string' => 'Nama produk harus berupa teks.',
      'nama_produk.unique' => 'Nama produk sudah ada.',
      'nama_produk.max' => 'Nama produk tidak boleh lebih dari :max karakter.',
      'deskripsi_produk.required' => 'Deskripsi produk harus diisi.',
      'deskripsi_produk.string' => 'Deskripsi produk harus berupa teks.',
      'harga_produk.required' => 'Harga produk harus diisi.',
      'harga_produk.numeric' => 'Harga produk harus berupa angka.',
      'harga_produk.min' => 'Harga produk harus bernilai minimal :min.',
      'stok_produk.required' => 'Stok produk harus diisi.',
      'stok_produk.integer' => 'Stok produk harus berupa bilangan bulat.',
      'stok_produk.min' => 'Stok produk harus bernilai minimal :min.',
      'rop_produk.required' => 'ROP harus diisi.',
      'rop_produk.integer' => 'ROP harus berupa bilangan bulat.',
      'rop_produk.min' => 'ROP harus bernilai minimal :min.',
      'lead_time_produk.required' => 'Lead Time harus diisi.',
      'lead_time_produk.integer' => 'Lead Time harus berupa bilangan bulat.',
      'lead_time_produk.min' => 'Lead Time harus bernilai minimal :min.',
      'foto_produk.required' => 'Foto produk harus diunggah.',
      'foto_produk.image' => 'File yang diunggah harus berupa gambar.',
      'foto_produk.mimes' => 'Format gambar yang diizinkan adalah jpeg, png, jpg, atau gif.',
      'foto_produk.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobita.',
      'tanggal_kedaluwarsa.required' => 'Tanggal Kedaluwarsa harus diisi.',
      'tanggal_kedaluwarsa.integer' => 'Tanggal Kedaluwarsa harus berupa bilangan bulat.',
      'tanggal_kedaluwarsa.min' => 'Tanggal Kedaluwarsa harus bernilai minimal :min.',
    ]);

    // Setelah validasi berhasil, lanjutkan dengan menyimpan data ke database atau melakukan proses lainnya.
    $file = $request->file('foto_produk');
    $nama_foto = time() . '_' . $request->file('foto_produk')->getClientOriginalName();
    Storage::putFileAs('public/upload/foto_produk', $file, $nama_foto);


    $idAgen = Agen::where('id_user', $request->id_user)->first();

    $produk = Produk::create([
      'id_agen' => $idAgen->id,
      'nama_produk' => strtolower($validatedData['nama_produk']),
      'deskripsi_produk' => $validatedData['deskripsi_produk'],
      'harga_produk' => $validatedData['harga_produk'],
      'stok_produk' => $validatedData['stok_produk'],
      'stok_realtime_produk' => $validatedData['stok_produk'],
      'rop_produk' => $validatedData['rop_produk'],
      'lead_time_produk' => $validatedData['lead_time_produk'],
      'foto_produk' => '/upload/foto_produk/' . $nama_foto,
    ]);

    // Ambil tanggal saat ini
    $tanggalSekarang = Carbon::now()->toDateString();

    // Hitung tanggal expired 30 hari dari sekarang
    $tanggalExpired = Carbon::now()->addDays(intval($validatedData['tanggal_kedaluwarsa']))->toDateString();

    $telurExpired = TelurExpired::create([
      'id_produk' => $produk->id,
      'stok_masuk' => $validatedData['stok_produk'],
      'tanggal_restok' => $tanggalSekarang,
      'tanggal_kedaluwarsa' => $tanggalExpired,
    ]);

    // Jika ingin kembalikan respons atau redirect setelah berhasil disimpan
    return redirect()->route('agen.produk')->with('success', 'Selamat! Produk baru Anda telah berhasil ditambahkan ke katalog.');
  }


  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $produk)
  {

    $slug = Str::of($produk)->replace('-', ' ');

    $produks = Produk::where('nama_produk', $slug)->first();

    $telurExpired = TelurExpired::where('id_produk', $produks->id)->first();

    $tanggalKedaluwarsa = Carbon::parse($telurExpired->tanggal_kedaluwarsa);
    $tanggalRestock = Carbon::parse($telurExpired->tanggal_restock);

    $selisihHari = intval($tanggalRestock->diffInDays($tanggalKedaluwarsa)) + 1;

    return view('agen.produk.edit', compact('produks', 'selisihHari', 'produk'));
  }

  public function restock(Request $request, $id)
  {
    $produk = Produk::find($id);
    $telurExpired = TelurExpired::where('id_produk', $produk->id)->first();

    $validatedData = $request->validate([
      'stok_produk' => 'required|integer|min:0',
      'tanggal_kedaluwarsa' => 'required|integer|min:0',
    ], [
      'stok_produk.required' => 'Stok produk harus diisi.',
      'stok_produk.integer' => 'Stok produk harus berupa bilangan bulat.',
      'stok_produk.min' => 'Stok produk harus bernilai minimal :min.',
      'tanggal_kedaluwarsa.required' => 'Tanggal Kedaluwarsa harus diisi.',
      'tanggal_kedaluwarsa.integer' => 'Tanggal Kedaluwarsa harus berupa bilangan bulat.',
      'tanggal_kedaluwarsa.min' => 'Tanggal Kedaluwarsa harus bernilai minimal :min.',
    ]);

    $stokLama = $produk->stok_produk;

    $produk->stok_produk = $validatedData['stok_produk'] + $stokLama;
    $produk->stok_realtime_produk = $validatedData['stok_produk'] + $stokLama;
    $produk->save();

    // Ambil tanggal saat ini
    $tanggalSekarang = Carbon::now()->toDateString();

    // Hitung tanggal expired 30 hari dari sekarang
    $tanggalExpired = Carbon::now()->addDays(intval($validatedData['tanggal_kedaluwarsa']))->toDateString();

    $telurExpired = TelurExpired::create([
      'id_produk' => $produk->id,
      'stok_masuk' => $validatedData['stok_produk'],
      'tanggal_restok' => $tanggalSekarang,
      'tanggal_kedaluwarsa' => $tanggalExpired,
    ]);

    return redirect()->route('agen.produk')->with('success', 'Stok produk telah berhasil diperbarui!');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    $request->merge(['nama_produk' => strtolower($request->nama_produk)]);

    $validatedData = $request->validate([
      'nama_produk' => 'required|string|unique:produks,nama_produk,' . $request->id . '|max:255',
      'deskripsi_produk' => 'required|string',
      'harga_produk' => 'required|numeric|min:0',
      'stok_produk' => 'required|integer|min:0',
      'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB untuk gambar
    ], [
      'nama_produk.required' => 'Nama produk harus diisi.',
      'nama_produk.string' => 'Nama produk harus berupa teks.',
      'nama_produk.unique' => 'Nama produk sudah ada.',
      'nama_produk.max' => 'Nama produk tidak boleh lebih dari :max karakter.',
      'deskripsi_produk.required' => 'Deskripsi produk harus diisi.',
      'deskripsi_produk.string' => 'Deskripsi produk harus berupa teks.',
      'harga_produk.required' => 'Harga produk harus diisi.',
      'harga_produk.numeric' => 'Harga produk harus berupa angka.',
      'harga_produk.min' => 'Harga produk harus bernilai minimal :min.',
      'stok_produk.required' => 'Stok produk harus diisi.',
      'stok_produk.integer' => 'Stok produk harus berupa bilangan bulat.',
      'stok_produk.min' => 'Stok produk harus bernilai minimal :min.',
      'foto_produk.image' => 'File yang diunggah harus berupa gambar.',
      'foto_produk.mimes' => 'Format gambar yang diizinkan adalah jpeg, png, jpg, atau gif.',
      'foto_produk.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobita.',
    ]);

    // Temukan produk berdasarkan ID
    $produk = Produk::find($request->id);

    $stokLama = $produk->stok_produk;

    // Jika ada foto baru yang diunggah, proses unggahannya
    if ($request->hasFile('foto_produk')) {
      $file = $request->file('foto_produk');
      $nama_foto = time() . '_' . $request->file('foto_produk')->getClientOriginalName();
      Storage::putFileAs('public/upload/foto_produk', $file, $nama_foto);

      // Perbarui data produk termasuk foto
      $produk->update([
        'nama_produk' => strtolower($validatedData['nama_produk']),
        'deskripsi_produk' => $validatedData['deskripsi_produk'],
        'harga_produk' => $validatedData['harga_produk'],
        'stok_produk' => $validatedData['stok_produk'],
        'stok_realtime_produk' => $validatedData['stok_produk'],
        'foto_produk' => '/upload/foto_produk/' . $nama_foto,
      ]);
    } else {
      // Perbarui data produk tanpa foto
      $produk->update([
        'nama_produk' => strtolower($validatedData['nama_produk']),
        'deskripsi_produk' => $validatedData['deskripsi_produk'],
        'harga_produk' => $validatedData['harga_produk'],
        'stok_produk' => $validatedData['stok_produk'],
        'stok_realtime_produk' => $validatedData['stok_produk'],
      ]);
    }

    $telurExpired = TelurExpired::where('id_produk', $produk->id)->latest()->first();

    $stokBaru = $validatedData['stok_produk'];

    $stokMasukUpdate = $stokBaru - $stokLama;

    // Perbarui atau buat entri TelurExpired
    $telurExpired = TelurExpired::updateOrCreate(
      ['id' => $telurExpired->id],
      [
        'stok_masuk' => $stokMasukUpdate,
      ]
    );

    // Jika ingin kembalikan respons atau redirect setelah berhasil disimpan
    return redirect()->route('agen.produk')->with('success', 'Perubahan Anda telah disimpan! Produk tersebut telah berhasil diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    // Validasi input ID
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
      // Redirect jika ID tidak valid
      return redirect()->route('agen.produk')
        ->with('error', 'ID produk tidak valid. Harap masukkan ID yang benar.');
    }

    try {
      // Temukan produk berdasarkan ID
      $produk = Produk::findOrFail($id);

      // Hapus semua entri terkait di tabel TelurExpired
      TelurExpired::where('id_produk', $produk->id)->delete();

      // Hapus produk
      $produk->delete();

      // Redirect dengan pesan sukses
      return redirect()->route('agen.produk')
        ->with('success', 'Produk dan data terkait telah dihapus dari katalog. Perubahan ini efektif segera.');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      // Jika produk tidak ditemukan
      return redirect()->route('agen.produk')
        ->with('error', 'Produk tidak ditemukan atau telah dihapus sebelumnya.');
    } catch (\Illuminate\Database\QueryException $e) {
      // Jika terjadi error terkait integritas referensial
      return redirect()->route('agen.produk')
        ->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
    } catch (\Exception $e) {
      // Tangani error lainnya yang mungkin terjadi
      return redirect()->route('agen.produk')
        ->with('error', 'Terjadi kesalahan saat menghapus produk. Silakan coba lagi.');
    }
  }

  public function exportProduk()
  {
    // Ambil data produk berdasarkan rentang tanggal yang dipilih
    $produks = Produk::all();

    // Load view untuk PDF dan masukkan data produk
    $pdf = PDF::loadView('agen.pdf.produk', compact('produks'));

    // Download file PDF dengan nama yang mencakup rentang tanggal
    return $pdf->download('laporan-produk.pdf');
  }

  public function exportKedaluwarsa(Request $request)
  {
    // Ambil nilai tanggal dari request
    $startTanggalMasuk = $request->input('start_tanggal_masuk');
    $endTanggalMasuk = $request->input('end_tanggal_masuk');
    $startTanggalKedaluwarsa = $request->input('start_tanggal_kedaluwarsa');
    $endTanggalKedaluwarsa = $request->input('end_tanggal_kedaluwarsa');

    // Ambil data produk berdasarkan rentang tanggal masuk dan tanggal kedaluwarsa yang dipilih
    $telur_expired = TelurExpired::with('produk')
      ->whereBetween('tanggal_restok', [$startTanggalMasuk, $endTanggalMasuk])
      ->whereBetween('tanggal_kedaluwarsa', [$startTanggalKedaluwarsa, $endTanggalKedaluwarsa])
      ->get();

    // Load view untuk PDF dan masukkan data produk yang kedaluwarsa
    $pdf = PDF::loadView('agen.pdf.kedaluwarsa_produk', compact('telur_expired', 'startTanggalMasuk', 'endTanggalMasuk', 'startTanggalKedaluwarsa', 'endTanggalKedaluwarsa'));

    // Download file PDF dengan nama yang mencakup rentang tanggal
    return $pdf->download('laporan-kedaluwarsa-produk-' . $startTanggalMasuk . '-to-' . $endTanggalMasuk . '-exp-' . $startTanggalKedaluwarsa . '-to-' . $endTanggalKedaluwarsa . '.pdf');
  }
}
