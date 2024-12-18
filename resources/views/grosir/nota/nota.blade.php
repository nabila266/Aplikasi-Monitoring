<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nota Transaksi</title>
  @vite('resources/css/app.css')

  <style>
    /* Aturan cetak */
    @media print {
      @page {
        size: landscape;
      }

      body {
        width: 100%;
      }

      .no-print {
        display: none;
      }

      .container {
        padding: 0;
        margin: 0;
      }

      .bg-white {
        box-shadow: none;
      }
    }

    /* Aturan tambahan */
    .container {
      max-width: 800px;
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="container mx-auto mt-5 p-5 bg-white shadow rounded-lg">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Nota Transaksi</h1>

    <!-- Informasi Transaksi -->
    <div class="mb-4">
      <p><strong>Tanggal:</strong> {{ $dataFaktur->first()->created_at->format('d F Y') }}</p>
      <p><strong>No Faktur:</strong> {{ $dataFaktur->first()->no_faktur }}</p>
    </div>

    <!-- Informasi Grosir -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold text-gray-800">Informasi Grosir</h2>
      <p><strong>Nama Grosir:</strong> {{ $dataFaktur->first()->grosir->nama_grosir }}</p>
      <p><strong>Alamat Grosir:</strong> {{ $dataFaktur->first()->grosir->alamat_grosir }}</p>
      <p><strong>Telepon Grosir:</strong> {{ $dataFaktur->first()->grosir->nomor_telefon_grosir }}</p>
    </div>

    <!-- Daftar Produk -->
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Produk yang Dibeli</h2>
    <table class="min-w-full divide-y divide-gray-200 text-sm">
      <thead>
        <tr class="bg-gray-50">
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Satuan</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <!-- Looping untuk setiap produk dalam dataFaktur -->
        @foreach($dataFaktur as $data)
        <tr>
          <td class="px-6 py-4 whitespace-nowrap">{{ $data->produk->nama_produk }}</td>
          <td class="px-6 py-4 whitespace-nowrap">Rp{{ number_format($data->produk->harga_produk, 0, ',', '.') }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ $data->qty }}</td>
          <td class="px-6 py-4 whitespace-nowrap">Rp{{ number_format($data->produk->harga_produk * $data->qty, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        @php
        $subtotal = $dataFaktur->sum(fn($item) => $item->produk->harga_produk * $item->qty);
        $pengiriman = $dataFaktur->first()->jenis_pengiriman == 'darurat' ? '50000' : '20000';
        @endphp
        <tr class="bg-gray-50">
          <td colspan="3" class="text-right font-medium py-2 pr-2">Biaya Pengiriman</td>
          <td class="font-medium">Rp{{ number_format($pengiriman, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td colspan="3" class="text-right font-bold py-2 pr-2">Total</td>
          <td class="font-bold">
            Rp{{ number_format($subtotal + $pengiriman, 0, ',', '.') }}
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Informasi Pengiriman -->
    <div class="mt-8 mb-4">
      <h2 class="text-xl font-semibold text-gray-800">Informasi Pengiriman</h2>
      @if($distribusi)
      <p><strong>No Resi:</strong> {{ $distribusi->no_resi }}</p>
      <p><strong>Status Pengiriman:</strong> {{ ucfirst($distribusi->status_pengiriman) }}</p>
      <p><strong>Keterangan:</strong> {{ $distribusi->keterangan_pengiriman }}</p>
      @else
      <p><strong>Status Pengiriman:</strong> Belum tersedia</p>
      @endif
    </div>

    <!-- Tombol Cetak -->
    <div class="text-center mt-10 no-print">
      <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Cetak Nota</button>
    </div>
  </div>
</body>

</html>