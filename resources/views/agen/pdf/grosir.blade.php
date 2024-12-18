<!DOCTYPE html>
<html>

<head>
  <title>Daftar Grosir</title>
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
  <h2>Daftar Grosir</h2>

  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Nomor Telefon</th>
        <th>Alamat</th>
        <th>Foto</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($grosirs as $grosir)
      <tr>
        <td>{{ $grosir->nama_grosir }}</td>
        <td>{{ $grosir->nomor_telefon_grosir }}</td>
        <td>{{ $grosir->alamat_grosir }}</td>
        <td>
          <img src="{{ asset('storage/'.$produk->foto_produk) }}" alt="Foto Grosir">
        </td>
        <td>{{ ucwords($grosir->status) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
