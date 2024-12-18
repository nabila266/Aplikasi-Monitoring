<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aplikasi Grosir</title>

  @vite('resources/css/app.css')

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full">
  <div class="overflow-hidden">
    <div class="bg-white">
      @include('components.grosir.navbar')

      <div class="relative isolate pt-14">
        @foreach($transaksi as $no_faktur => $dataFaktur)
        <div class="max-w-2xl pt-16 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
          <!-- Title and Date -->
          <div class="px-4 space-y-2 sm:flex sm:items-baseline sm:justify-between sm:space-y-0 sm:px-0">
            <div class="flex sm:items-baseline sm:space-x-4">
              <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Pesanan {{ $no_faktur }}</h1>
              <a href="{{ route('transaksi.nota', $dataFaktur->first()->id) }}" class="hidden text-sm font-medium text-indigo-600 hover:text-indigo-500 sm:block">
                Lihat faktur
                <span aria-hidden="true"> →</span>
              </a>
            </div>
            <p class="text-sm text-gray-600">Pesanan dibuat <time datetime="{{ $dataFaktur->first()->created_at }}" class="font-medium text-gray-900">{{ $dataFaktur->first()->created_at->format('d F Y') }}</time></p>
          </div>

          <!-- Produk yang dipesan -->
          <div class="bg-white border-t border-b border-gray-200 shadow-sm sm:rounded-lg sm:border mt-6">
            <div class="px-4 py-6 sm:px-6 lg:grid lg:grid-cols-12 lg:gap-x-8 lg:p-8">
              <div class="lg:col-span-12">
                <h2 class="text-lg font-medium text-gray-900">Produk yang Dibeli</h2>
                <div class="space-y-8 mt-4">
                  <!-- Looping Produk -->
                  @foreach($dataFaktur as $data)
                  <div class="flex items-center space-x-4 pb-4 {{ !$loop->last ? 'border-b' : '' }}">
                    <div class="flex-shrink-0 w-24 h-24 overflow-hidden rounded-lg">
                      <img src="{{ asset('storage/'.$data->produk->foto_produk) }}" alt="Gambar Produk" class="object-cover object-center w-full h-full">
                    </div>

                    <div class="flex-1">
                      <h3 class="text-base font-medium text-gray-900">{{ ucwords($data->produk->nama_produk) }}</h3>
                      <p class="mt-2 text-sm font-medium text-gray-900">Rp{{ number_format($data->produk->harga_produk, 0, ',', '.') }} <span class="text-sm text-gray-400">/ Butir</span></p>
                      <p class="mt-2 text-sm font-medium text-gray-900"><span class="text-sm text-gray-400">Jumlah :</span> {{ $data->qty }}</p>
                      <p class="mt-3 text-sm text-gray-500">{{ $data->produk->deskripsi_produk }}</p>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <!-- Alamat Pengiriman dan Informasi Pengiriman -->
          <div class="mt-6 bg-gray-100 border-t border-b border-gray-200 shadow-sm sm:rounded-lg sm:border">
            <div class="px-4 py-6 sm:px-6 lg:grid lg:grid-cols-12 lg:gap-x-8 lg:p-8">
              <!-- Alamat Pengiriman -->
              <div class="lg:col-span-6">
                <h3 class="text-base font-medium text-gray-900">Alamat Pengiriman</h3>
                <p class="mt-2 text-sm text-gray-500">
                  {{ ucwords($dataFaktur->first()->grosir->nama_grosir) }} <br>
                  {{ $dataFaktur->first()->grosir->alamat_grosir }} <br>
                  {{ $dataFaktur->first()->grosir->nomor_telefon_grosir }}
                </p>
              </div>

              <!-- Informasi Pengiriman -->
              <div class="lg:col-span-6">
                <h3 class="text-base font-medium text-gray-900">Informasi Pengiriman</h3>
                <p class="mt-2 text-sm text-gray-500">
                  @php
                  $distribusi = \App\Models\Distribusi::where('id_transaksi', $dataFaktur->first()->id)->first();
                  @endphp
                  @if($distribusi)
                <p>No Resi: {{ $distribusi->no_resi }}</p>

                @if($distribusi->status_pengiriman == 'dalam perjalanan')
                <form action="{{ route('grosir.transaksi.pesanan-diterima', $distribusi->id) }}" method="POST" class="mt-4">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="font-medium bg-indigo-600 py-2 px-4 rounded text-white hover:bg-indigo-500">Pesanan Diterima</button>
                </form>
                @elseif($distribusi->status_pengiriman == 'diterima')
                <p class="text-indigo-600">Pesanan Anda telah diterima.</p>
                @endif
                @else
                <p>Status pengiriman belum tersedia.</p>
                @endif
                </p>
              </div>
            </div>
          </div>

          <!-- Progress Bar -->
          <div class="px-4 py-6 sm:px-6 lg:px-8">
            <h4 class="sr-only">Status</h4>
            <p class="text-sm font-medium text-gray-900">
              @if($dataFaktur->first()->status == 'pending')
              Transaksi Anda sedang dalam proses verifikasi oleh tim kami.
              @elseif($dataFaktur->first()->status == 'berhasil')
              @if($distribusi)
              @if($distribusi->status_pengiriman == 'diproses')
              Pesanan Anda telah diproses dan akan segera dikirim.
              @elseif($distribusi->status_pengiriman == 'dalam perjalanan')
              Pesanan Anda dalam perjalanan.
              @elseif($distribusi->status_pengiriman == 'diterima')
              Terima kasih, pesanan Anda telah diterima.
              @endif
              @else
              Status pengiriman belum tersedia.
              @endif
              @elseif($dataFaktur->first()->status == 'gagal')
              Mohon maaf, transaksi Anda tidak dapat diproses.
              @endif
            </p>

            <div class="mt-6" aria-hidden="true">
              <div class="overflow-hidden bg-gray-200 rounded-full">
                @if($dataFaktur->first()->status == 'pending')
                <div class="h-2 bg-indigo-600 rounded-full" style="width: calc((1) / 8 * 100%);"></div>
                @elseif($dataFaktur->first()->status == 'berhasil')
                @if($distribusi)
                @if($distribusi->status_pengiriman == 'diproses')
                <div class="h-2 bg-indigo-600 rounded-full" style="width: calc((3) / 8 * 100%);"></div>
                @elseif($distribusi->status_pengiriman == 'dalam perjalanan')
                <div class="h-2 bg-indigo-600 rounded-full" style="width: calc((5) / 8 * 100%);"></div>
                @elseif($distribusi->status_pengiriman == 'diterima')
                <div class="h-2 bg-indigo-600 rounded-full" style="width: calc((8) / 8 * 100%);"></div>
                @endif
                @else
                <div class="h-2 bg-gray-600 rounded-full" style="width: calc((2) / 8 * 100%);"></div>
                @endif
                @elseif($dataFaktur->first()->status == 'gagal')
                <div class="h-2 bg-red-600 rounded-full" style="width: calc((8) / 8 * 100%);"></div>
                @endif
              </div>

              <!-- Steps Indicator -->
              <div class="hidden grid-cols-4 mt-6 text-sm font-medium text-gray-600 sm:grid">
                <div class="text-indigo-600">Pesanan dibuat</div>
                <div class="text-center {{ $distribusi && $distribusi->status_pengiriman == 'diproses' || $distribusi && $distribusi->status_pengiriman == 'dalam perjalanan' || $distribusi && $distribusi->status_pengiriman == 'diterima' ? 'text-indigo-600' : '' }}">Diproses</div>
                <div class="text-center {{ $distribusi && $distribusi->status_pengiriman == 'dalam perjalanan' || $distribusi && $distribusi->status_pengiriman == 'diterima' ? 'text-indigo-600' : '' }}">Dikirim</div>
                <div class="text-right {{ $distribusi && $distribusi->status_pengiriman == 'diterima' ? 'text-indigo-600' : '' }}">Diterima</div>
              </div>
            </div>
          </div>

          <!-- Ringkasan Penagihan -->
          <div class="mt-16">
            <h2 class="sr-only">Ringkasan Penagihan</h2>

            <div class="px-4 py-6 bg-gray-100 sm:rounded-lg sm:px-6 lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8 lg:py-8">
              <dl class="grid grid-cols-2 gap-6 text-sm sm:grid-cols-2 md:gap-x-8 lg:col-span-7">
                @php
                $subtotal = $dataFaktur->sum(fn($item) => $item->produk->harga_produk * $item->qty);
                $pengiriman = $dataFaktur->first()->jenis_pengiriman == 'darurat' ? '50000' : '20000';
                @endphp
                <div>
                  <dt class="font-medium text-gray-900">Subtotal</dt>
                  <dd class="mt-3 text-gray-500">
                    Rp{{ number_format($subtotal, 0, ',', '.') }}
                  </dd>
                </div>
                <div>
                  <dt class="font-medium text-gray-900">Biaya Pengiriman</dt>
                  <dd class="mt-3 text-gray-500">
                    Rp{{ number_format($pengiriman, 0, ',', '.') }}
                  </dd>
                </div>
                <div class="col-span-2">
                  <dt class="font-medium text-gray-900">Total</dt>
                  <dd class="mt-3 text-gray-500">
                    Rp{{ number_format($subtotal + $pengiriman, 0, ',', '.') }}
                  </dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  @include('components.grosir.footer')
</body>

</html>