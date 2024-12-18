<!DOCTYPE html>
<html>

<head>
  <title>Laporan Kedaluwarsa Produk</title>
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
  <h2>Laporan Kedaluwarsa Produk</h2>
  <p>Periode Tanggal Masuk: {{ $startTanggalMasuk }} - {{ $endTanggalMasuk }}</p>
  <p>Periode Tanggal Kedaluwarsa: {{ $startTanggalKedaluwarsa }} - {{ $endTanggalKedaluwarsa }}</p>

  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Stok Masuk</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Kedaluwarsa</th>
      </tr>
    </thead>
    <tbody>
      @foreach($telur_expired as $telur)
      <tr>
        <td>{{ ucwords($telur->produk->nama_produk) }}</td>
        <td>{{ $telur->stok_masuk }}</td>
        <td>{{ \Carbon\Carbon::parse($telur->tanggal_restok)->format('d M Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($telur->tanggal_kedaluwarsa)->format('d M Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>