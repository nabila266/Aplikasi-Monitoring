<!DOCTYPE html>
<html>

<head>
  <title>Laporan Manajemen JIT</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
    }
  </style>
</head>

<body>
  <h2>Laporan Manajemen JIT</h2>

  <table>
    <thead>
      <tr>
        <th>Jumlah Perhitungan Optimal</th>
        <th>Quantitas Pesanan Optimal</th>
        <th>Kuantitas Pengiriman Optimal</th>
        <th>Frekuensi Pesanan</th>
        <th>Total Biaya Persediaan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($perhitunganJIT as $jit)
      <tr>
        <td>{{ $jit->jumlah_pengiriman_optimal }}</td>
        <td>{{ $jit->kuantitas_pesanan_optimal }}</td>
        <td>{{ $jit->kuantitas_pengiriman_optimal }}</td>
        <td>{{ $jit->frekuensi_pesanan }}</td>
        <td>{{ $jit->total_biaya_persediaan }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
