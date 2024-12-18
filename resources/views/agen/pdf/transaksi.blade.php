<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h2>Laporan Transaksi</h2>
  <table>
    <thead>
      <tr>
        <th>No Faktur</th>
        <th>Produk</th>
        <th>Total Harga</th>
        <th>Jumlah</th>
        <th>Jenis Pengiriman</th>
        <th>Status</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($transaksis as $transaksi)
      <tr>
        <td>{{ $transaksi->no_faktur }}</td>
        <td>{{ $transaksi->produk->nama_produk }}</td>
        <td>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
        <td>{{ $transaksi->qty }}</td>
        <td>{{ ucwords($transaksi->jenis_pengiriman) }}</td>
        <td>{{ ucwords($transaksi->status) }}</td>
        <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>