<?php

namespace App\Http\Controllers\Agen;

use Carbon\Carbon;
use App\Models\Agen;
use App\Models\Produk;
use App\Models\Pembelian;
use App\Models\TelurExpired;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AgenPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian = Pembelian::with('produk')->latest()->get();

        return view('agen.pembelian', compact('pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produk = Produk::where('status', 'tersedia')->get();

        return view('agen.pembelian.create', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'no_faktur' => 'required',
            'harga_beli' => 'required',
            'biaya_pemesanan' => 'required',
            'select-produk' => 'nullable|exists:produks,id',
            'nama_produk_baru' => 'nullable|string|max:255',
            'deskripsi_produk' => 'nullable|string', // Diubah menjadi opsional
            'harga_produk' => 'nullable|numeric|min:0', // Diubah menjadi opsional
            'stok_produk' => 'required|integer|min:0',
            'tanggal_kedaluwarsa' => 'nullable|integer|min:0', // Diubah menjadi opsional
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Diubah menjadi opsional
        ])->after(function ($validator) use ($request) {
            if ($request->filled('select-produk') && $request->filled('nama_produk_baru')) {
                $validator->errors()->add('select-produk', 'Silakan pilih salah satu antara produk yang sudah ada atau masukkan produk baru, tidak keduanya.');
                $validator->errors()->add('nama_produk_baru', 'Silakan pilih salah satu antara produk yang sudah ada atau masukkan produk baru, tidak keduanya.');
            }

            if (!$request->filled('select-produk') && !$request->filled('nama_produk_baru')) {
                $validator->errors()->add('select-produk', 'Anda harus memilih produk yang sudah ada atau memasukkan nama produk baru.');
                $validator->errors()->add('nama_produk_baru', 'Anda harus memilih produk yang sudah ada atau memasukkan nama produk baru.');
            }
        });

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Proses unggah foto jika ada
        $nama_foto = null;
        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $nama_foto = time() . '_' . $request->file('foto_produk')->getClientOriginalName();
            Storage::putFileAs('public/upload/foto_produk', $file, $nama_foto);
        }

        // Ambil ID agen
        $idAgen = Agen::where('id_user', $request->id_user)->first();

        // Cek apakah pengguna memasukkan produk baru atau memilih produk yang sudah ada
        if ($request->filled('nama_produk_baru')) {
            $produk = $this->buatProdukBaru($request, $idAgen->id, $nama_foto);
        } else {
            $produk = $this->updateProdukYangAda($request, $nama_foto);
        }

        if ($produk) {
            return redirect()->route('agen.transaksi.pembelian')->with('success', 'Selamat! Pembelian produk Anda berhasil ditambahkan ke katalog.');
        } else {
            return redirect()->route('agen.transaksi.pembelian')->with('error', 'Maaf, terjadi kesalahan saat menambahkan produk ke katalog. Silakan coba lagi.');
        }
    }

    // Fungsi untuk membuat produk baru
    private function buatProdukBaru($request, $idAgen, $nama_foto)
    {
        $produk = Produk::create([
            'id_agen' => $idAgen,
            'nama_produk' => strtolower($request->input('nama_produk_baru')),
            'deskripsi_produk' => $request->input('deskripsi_produk'),
            'harga_produk' => $request->input('harga_produk'),
            'stok_produk' => $request->input('stok_produk'),
            'stok_realtime_produk' => $request->input('stok_produk'),
            'foto_produk' => $nama_foto ? '/upload/foto_produk/' . $nama_foto : null,
        ]);

        $this->buatTelurExpired($produk->id, $request->input('stok_produk'), $request->input('tanggal_kedaluwarsa'));

        $this->buatPembelian($produk->id, $request);

        return $produk;
    }

    // Fungsi untuk memperbarui stok produk yang sudah ada
    private function updateProdukYangAda($request, $nama_foto)
    {
        $produk = Produk::find($request->input('select-produk'));
        $produkStok = $produk->stok_produk;

        // Ambil tanggal kedaluwarsa dari entri terakhir TelurExpired jika tidak diisi
        $tanggalKedaluwarsa = $request->input('tanggal_kedaluwarsa');
        if (!$tanggalKedaluwarsa) {
            $telurExpiredTerakhir = TelurExpired::where('id_produk', $produk->id)->latest()->first();
            $tanggalKedaluwarsa = $telurExpiredTerakhir ? $telurExpiredTerakhir->tanggal_kedaluwarsa : null;
        }

        $this->buatTelurExpired($produk->id, $request->input('stok_produk'), $tanggalKedaluwarsa);

        $this->buatPembelian($produk->id, $request);

        $produk->stok_produk = $produkStok + $request->input('stok_produk');
        $produk->stok_realtime_produk = $produkStok + $request->input('stok_produk');
        $produk->deskripsi_produk = $request->input('deskripsi_produk') ?? $produk->deskripsi_produk;
        $produk->harga_produk = $request->input('harga_produk') ?? $produk->harga_produk;
        $produk->foto_produk = $nama_foto ? '/upload/foto_produk/' . $nama_foto : $produk->foto_produk;
        $produk->save();

        return $produk;
    }

    // Fungsi untuk membuat data TelurExpired
    private function buatTelurExpired($idProduk, $stokMasuk, $tanggalKedaluwarsa)
    {
        $tanggalSekarang = Carbon::now()->toDateString();
        $tanggalExpired = Carbon::now()->addDays(intval($tanggalKedaluwarsa))->toDateString();

        TelurExpired::create([
            'id_produk' => $idProduk,
            'stok_masuk' => $stokMasuk,
            'tanggal_restok' => $tanggalSekarang,
            'tanggal_kedaluwarsa' => $tanggalExpired,
        ]);
    }

    // Fungsi untuk membuat data Pembelian
    private function buatPembelian($idProduk, $request)
    {
        Pembelian::create([
            'id_produk' => $idProduk,
            'no_faktur' => $request->input('no_faktur'),
            'stok_masuk' => $request->input('stok_produk'),
            'harga_beli' => $request->input('harga_beli'),
            'biaya_pemesanan' => $request->input('biaya_pemesanan'),
        ]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
