<!DOCTYPE html>
<html>

<head>
  <title>Laporan Produk</title>
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

    img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <h2>Laporan Produk</h2>

  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Foto</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($produks as $produk)
      <tr>
        <td>{{ $produk->nama_produk }}</td>
        <td>{{ $produk->deskripsi_produk }}</td>
        <td>Rp{{ number_format($produk->harga_produk, 0, ',', '.') }}</td>
        <td>{{ $produk->stok_produk }}</td>
        <td>
          <img src="{{ $produk->foto_produk ? public_path($produk->foto_produk) : public_path('upload/foto_produk/default.png') }}" alt="Foto Produk">
        </td>
        <td>{{ ucfirst($produk->status) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
