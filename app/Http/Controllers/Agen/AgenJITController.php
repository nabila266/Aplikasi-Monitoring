<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use App\Imports\JITImport;
use App\Models\JIT;
use App\Models\PerhitunganJIT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AgenJITController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $perhitunganJIT = PerhitunganJIT::with('jit')->get();
      return view('agen.jit.index', compact('perhitunganJIT'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('agen.jit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ubah input null menjadi 0
        $inputs = collect($request->all())->map(function ($item) {
            return $item === null ? 0 : $item;
        })->toArray();
    
        $validatedData = Validator::make($inputs, [
            'kuantitas_pemesanan' => 'numeric',
            'rata_rata_target_persediaan' => 'numeric',
            'biaya_pemesanan_per_unit' => 'numeric',
            'jumlah_kebutuhan_bahan_baku_tahunan' => 'numeric',
            'biaya_penyimpanan_per_unit' => 'numeric',
        ], [
            'kuantitas_pemesanan.numeric' => 'Kuantitas pemesanan harus berupa angka.',
            'rata_rata_target_persediaan.numeric' => 'Rata-rata target persediaan harus berupa angka.',
            'biaya_pemesanan_per_unit.numeric' => 'Biaya pemesanan per unit harus berupa angka.',
            'jumlah_kebutuhan_bahan_baku_tahunan.numeric' => 'Jumlah kebutuhan bahan baku tahunan harus berupa angka.',
            'biaya_penyimpanan_per_unit.numeric' => 'Biaya penyimpanan per unit harus berupa angka.',
        ])->validate();
    
        $jit = JIT::create($validatedData);
    
        // Melakukan perhitungan berdasarkan data yang divalidasi dan tersimpan
        $Q = $jit->kuantitas_pemesanan;
        $a = $jit->rata_rata_target_persediaan;
        $O = $jit->biaya_pemesanan_per_unit;
        $D = $jit->jumlah_kebutuhan_bahan_baku_tahunan;
        $C = $jit->biaya_penyimpanan_per_unit;
    
        // 1. Jumlah pengiriman optimal (na)
        $na = ($a > 0) ? $Q / (2 * $a) : 0;
    
        // 2. Kuantitas pesanan optimal (Qn)
        $Qn = sqrt(4 * $Q);
    
        // 3. Kuantitas pengiriman optimal (q)
        $q = $Qn / $na;
    
        // 4. Frekuensi pemesanan (N)
        $N = $D / $Qn;
    
        // 5. Total biaya persediaan (Tjit)
        $Tjit = (($C * $Qn) / (2 * $na)) + (($O * $D) / $Qn);
    
        $perhitunganJIT = PerhitunganJIT::create([
            'id_jit' => $jit->id,
            'jumlah_pengiriman_optimal' => $na,
            'kuantitas_pesanan_optimal' => $Qn,
            'kuantitas_pengiriman_optimal' => $q,
            'frekuensi_pesanan' => $N,
            'total_biaya_persediaan' => $Tjit,
        ]);
    
        return redirect()->route('agen.jit.index')->with('success', 'Data berhasil ditambah dan perhitungan JIT telah dilakukan.');
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
      $jit = JIT::find($id);
      return view('agen.jit.edit', compact('jit'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
  {
    // Ubah input null menjadi 0
    $inputs = collect($request->all())->map(function ($item) {
      return $item === null ? 0 : $item;
    })->toArray();

    $validatedData = Validator::make($inputs, [
      'kuantitas_pemesanan' => 'numeric',
      'rata_rata_target_persediaan' => 'numeric',
      'biaya_pemesanan_per_unit' => 'numeric',
      'jumlah_kebutuhan_bahan_baku_tahunan' => 'numeric',
      'biaya_penyimpanan_per_unit' => 'numeric',
    ], [
      'kuantitas_pemesanan.numeric' => 'Kuantitas pemesanan harus berupa angka.',
      'rata_rata_target_persediaan.numeric' => 'Rata-rata target persediaan harus berupa angka.',
      'biaya_pemesanan_per_unit.numeric' => 'Biaya pemesanan per unit harus berupa angka.',
      'jumlah_kebutuhan_bahan_baku_tahunan.numeric' => 'Jumlah kebutuhan bahan baku tahunan harus berupa angka.',
      'biaya_penyimpanan_per_unit.numeric' => 'Biaya penyimpanan per unit harus berupa angka.',
    ])->validate();

    // Cari record JIT yang ada berdasarkan ID
    $jit = JIT::findOrFail($id);
    $jit->update($validatedData);

    // Melakukan perhitungan berdasarkan data yang divalidasi dan tersimpan
    $Q = $jit->kuantitas_pemesanan;
    $a = $jit->rata_rata_target_persediaan;
    $O = $jit->biaya_pemesanan_per_unit;
    $D = $jit->jumlah_kebutuhan_bahan_baku_tahunan;
    $C = $jit->biaya_penyimpanan_per_unit;

    // Perhitungan
    $na = ($a > 0) ? pow(($Q / (2 * $a)), 2) : 0;
    $Qn = ($na > 0) ? sqrt($na * $Q) : 0;
    $q = ($na > 0) ? $Qn / $na : 0;
    $N = ($Qn > 0) ? $D / $Qn : 0;
    $Tjit = ($Qn > 0 && $na > 0) ? ($C * $Qn / (2 * $na)) + ($O * $D / $Qn) : 0;

    // Perbarui record Perhitungan JIT yang sesuai
    $perhitunganJIT = PerhitunganJIT::where('id_jit', $jit->id)->first();
    if ($perhitunganJIT) {
      $perhitunganJIT->update([
        'jumlah_pengiriman_optimal' => $na,
        'kuantitas_pesanan_optimal' => $Qn,
        'kuantitas_pengiriman_optimal' => $q,
        'frekuensi_pesanan' => $N,
        'total_biaya_persediaan' => $Tjit,
      ]);
    }

    return redirect()->route('agen.jit.index')->with('success', 'Data JIT berhasil diperbarui dan perhitungan JIT telah dilakukan.');
  }

  /**
     * Remove the specified resource from storage.
     */
  public function destroy(string $id)
  {
    $jit = JIT::findOrFail($id); // Mengganti `find` dengan `findOrFail` untuk menangani tidak ditemukannya record

    // Cari dan hapus entri PerhitunganJIT terkait, jika ada
    $perhitunganJIT = PerhitunganJIT::where('id_jit', $jit->id)->first();
    if ($perhitunganJIT) {
      $perhitunganJIT->delete();
    }

    // Juga hapus entri JIT setelah tidak ada lagi ketergantungan yang tersisa
    $jit->delete();

    // Redirect ke halaman sebelumnya dengan pesan sukses
    return redirect()->route('agen.jit.index')->with('success', 'Data JIT dan perhitungan terkait berhasil dihapus.');
  }

  public function importExcel(Request $request)
  {
    $request->validate([
      'file' => 'required|mimes:xls,xlsx',
    ]);

    Excel::import(new JITImport, $request->file('file'));

    return redirect()->route('agen.jit.index')->with('success', 'Data berhasil diimpor dan perhitungan JIT telah dilakukan');
  }
}
