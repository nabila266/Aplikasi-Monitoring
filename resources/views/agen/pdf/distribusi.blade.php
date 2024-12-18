<!DOCTYPE html>
<html>

<head>
  <title>Laporan Distribusi</title>
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
  <h2>Laporan Distribusi</h2>
  <p>Periode: {{ request()->start_date }} - {{ request()->end_date }}</p>

  <table>
    <thead>
      <tr>
        <th>No Faktur</th>
        <th>No Resi</th>
        <th>Tanggal Pengiriman</th>
        <th>Keterangan</th>
        <th>Status Pengiriman</th>
      </tr>
    </thead>
    <tbody>
      @foreach($distribusis as $distribusi)
      <tr>
        <td>{{ $distribusi->transaksi->no_faktur }}</td>
        <td>{{ $distribusi->no_resi ?? '-' }}</td>
        <td>{{ $distribusi->tanggal_pengiriman ?? '-' }}</td>
        <td>{{ $distribusi->keterangan_pengiriman ?? '-' }}</td>
        <td>{{ ucwords($distribusi->status_pengiriman) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>