<?php

  namespace App\Imports;

  use App\Models\JIT;
  use App\Models\PerhitunganJIT;
  use Illuminate\Support\Collection;
  use Maatwebsite\Excel\Concerns\ToCollection;
  use Maatwebsite\Excel\Concerns\WithHeadingRow;
  use Illuminate\Support\Facades\Validator;

  class JITImport implements ToCollection, WithHeadingRow
  {
    public function collection(Collection $rows)
    {
      foreach ($rows as $row) {
        // Ubah input null menjadi 0
        $inputs = collect($row)->map(function ($item) {
          return $item === null ? 0 : $item;
        })->toArray();

        // Validasi data
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

        // Simpan data JIT
        $jit = JIT::create($validatedData);

        // Lakukan perhitungan berdasarkan data yang divalidasi dan tersimpan
        $Q = $jit->kuantitas_pemesanan;
        $a = $jit->rata_rata_target_persediaan;
        $O = $jit->biaya_pemesanan_per_unit;
        $D = $jit->jumlah_kebutuhan_bahan_baku_tahunan;
        $C = $jit->biaya_penyimpanan_per_unit;

        // 1. Jumlah pengiriman optimal (na)
        $na = ($a > 0) ? pow(($Q / (2 * $a)), 2) : 0;

        // 2. Kuantitas pesanan optimal (Qn)
        $Qn = ($na > 0) ? sqrt($na * $Q) : 0;

        // 3. Kuantitas pengiriman optimal (q)
        $q = ($na > 0) ? $Qn / $na : 0;

        // 4. Frekuensi pemesanan (N)
        $N = ($Qn > 0) ? $D / $Qn : 0;

        // 5. Total biaya persediaan (Tjit)
        $Tjit = ($Qn > 0 && $na > 0) ? ($C * $Qn / (2 * $na)) + ($O * $D / $Qn) : 0;

        // Simpan hasil perhitungan ke tabel PerhitunganJIT
        PerhitunganJIT::create([
          'id_jit' => $jit->id,
          'jumlah_pengiriman_optimal' => $na,
          'kuantitas_pesanan_optimal' => $Qn,
          'kuantitas_pengiriman_optimal' => $q,
          'frekuensi_pesanan' => $N,
          'total_biaya_persediaan' => $Tjit,
        ]);
      }
    }
  }
