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

  <div x-data="{ open: false }" @keydown.window.escape="open = false">

    <div x-show="open" class="relative z-50 lg:hidden" x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog" aria-modal="true">

      <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80" x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state."></div>


      <div class="fixed inset-0 flex">

        <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" x-description="Off-canvas menu, show/hide based on off-canvas menu state." class="relative mr-16 flex w-full max-w-xs flex-1" @click.away="open = false">

          <div x-show="open" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Close button, show/hide based on off-canvas menu state." class="absolute left-full top-0 flex w-16 justify-center pt-5">
            <button type="button" class="-m-2.5 p-2.5" @click="open = false">
              <span class="sr-only">Close sidebar</span>
              <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>

          <!-- Sidebar component, swap this element with another sidebar if you like -->
          @include('components.agen.navbar')

        </div>

      </div>
    </div>

    <!-- Static sidebar for desktop -->
    @include('components.agen.sidebar')

    <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 shadow-sm sm:px-6 lg:hidden">
      <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="open = true">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
        </svg>
      </button>
      <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">Dashboard</div>
      <a href="#">
        <span class="sr-only">Your profile</span>
        <img class="h-8 w-8 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
      </a>
    </div>

    <main class="py-10 lg:pl-72">
      <div class="px-4 sm:px-6 lg:px-8">
        <div class="relative h-full overflow-hidden rounded-xl shadow-sm">
          @include('components.agen.alerts')
          <div class="bg-white py-10">
            <div class="mx-auto max-w-7xl">


              <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                  <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Pembelian Produk ke Distributor</h1>
                    <p class="mt-2 text-sm text-gray-700">Detail pembelian produk ini mencakup informasi tentang distributor, jumlah produk yang dipesan, harga satuan, dan total biaya yang harus dibayarkan.</p>
                  </div>
                  <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a href="/agen/transaksi/pembelian/tambah/" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Pembelian</a>
                  </div>
                </div>
                <!-- <div class="sm:flex sm:items-center">
                  <div class="sm:flex-auto">
                    <form action="{{ route('manajemenJIT.exportPDF') }}" method="GET" class="flex flex-col sm:flex-row sm:items-end sm:space-x-4 space-y-4 sm:space-y-0">
                      <div class="flex flex-col sm:flex-1">
                        <label for="start_date" class="text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      </div>
                      <div class="flex flex-col sm:flex-1">
                        <label for="end_date" class="text-sm font-medium text-gray-700">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="end_date" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      </div>
                      <div class="flex sm:flex-none">
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 w-full sm:w-auto">
                          Ekspor PDF
                        </button>
                      </div>
                    </form>
                  </div>
                </div> -->

                <!-- Wrap the table in a div with overflow-x-auto -->
                <div class="mt-8 overflow-x-auto">
                  <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                      <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                          No Faktur
                        </th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 xl:table-cell">
                          Nama Produk
                        </th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                          Stok Masuk
                        </th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 md:table-cell">
                          Harga Beli
                        </th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                          Biaya Pemesanan
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sr-only">Status</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                          <span class="sr-only">Restok</span>
                          <span class="sr-only">Edit</span>
                          <span class="sr-only">Hapus</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                      @foreach($pembelian as $item)
                      <tr>
                        <td class="w-fit max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-0 ">
                          {{ $item->no_faktur }}

                          <dl class="font-normal lg:hidden">
                            <dt class="sr-only">Nama Produk</dt>
                            <dd class="mt-1 truncate text-gray-700 ">
                              {{ ucwords($item->produk->nama_produk) }}
                            </dd>
                            <dt class="sr-only sm:hidden">Harga Beli</dt>
                            <dd class="mt-1 truncate text-gray-500 md:hidden">
                              Rp{{ number_format($item->harga_beli, 0, ',', '.') }}</dd>
                            <dt class="sr-only sm:hidden">Stok Masuk</dt>
                            <dd class="mt-1 truncate text-gray-500 lg:hidden">{{ $item->stok_masuk }}</dd>
                          </dl>
                        </td>
                        <dt class="sr-only sm:hidden">Biaya Pemesanan</dt>
                        <dd class="mt-1 truncate text-gray-500 lg:hidden">Rp{{ number_format($item->biaya_pemesanan, 0, ',', '.') }}</dd>
                        </dl>
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 w-1/4 xl:table-cell">
                          <span class="line-clamp-2">
                            {{ ucwords($item->produk->nama_produk) }}
                          </span>
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">
                          {{ $item->stok_masuk }}
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 md:table-cell">
                          Rp{{ number_format($item->harga_beli, 0, ',', '.') }}
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 md:table-cell">
                          Rp{{ number_format($item->biaya_pemesanan, 0, ',', '.') }}
                        </td>

                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </main>

    <main class="py-10 lg:pl-72">
      <div class="px-4 sm:px-6 lg:px-8">
        <div class="relative h-full overflow-hidden rounded-xl shadow-sm">
          <div class="bg-white py-10">
            <div class="mx-auto max-w-7xl">
              <div class="px-4 sm:px-6 lg:px-8">

                <div class="sm:flex-auto mb-4">
                  <h1 class="text-base font-semibold leading-6 text-gray-900">Total Transaksi</h1>
                  <p class="mt-2 text-sm text-gray-700">Detail dari transaksi pembelian.</p>
                </div>

                <div class="flex flex-col">
                  <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                      <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead>
                            <tr>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-900">Nama Produk</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-900">Total Stok Masuk</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-900">Total Harga Beli</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-900">Total Biaya Pemesanan</th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200">

                            @php
                            $pembelianGrouped = \App\Models\Pembelian::with('produk')
                            ->selectRaw('id_produk, SUM(stok_masuk) as stok_masuk')
                            ->selectRaw('id_produk, SUM(harga_beli) as harga_beli')
                            ->selectRaw('id_produk, SUM(biaya_pemesanan) as biaya_pemesanan')
                            ->groupBy('id_produk')
                            ->get();
                            @endphp

                            @foreach($pembelianGrouped as $transaksi)
                            <tr>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 capitalize">{{ $transaksi->produk->nama_produk }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $transaksi->stok_masuk }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $transaksi->harga_beli }}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $transaksi->biaya_pemesanan }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

</body>

</html>
