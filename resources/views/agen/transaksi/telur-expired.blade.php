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
          <div class="bg-white py-10">
            <div class="mx-auto max-w-7xl">

              <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                  <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Kedaluwarsa Produk</h1>
                    <p class="mt-2 text-sm text-gray-700">Berikut adalah daftar semua kedaluwarsa produk dengan nama, stok masuk, tanggal masuk, dan tanggal kedaluwarsa.</p>
                  </div>
                </div>
                <div class="sm:flex sm:items-center">
                  <div class="sm:flex-auto mt-4">
                    <form action="{{ route('kedaluwarsa.exportPDF') }}" method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                      <div class="flex flex-col">
                        <label for="start_tanggal_masuk" class="text-sm font-medium text-gray-700">Tanggal Masuk Mulai</label>
                        <input type="date" name="start_tanggal_masuk" id="start_tanggal_masuk" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      </div>
                      <div class="flex flex-col">
                        <label for="end_tanggal_masuk" class="text-sm font-medium text-gray-700">Tanggal Masuk Akhir</label>
                        <input type="date" name="end_tanggal_masuk" id="end_tanggal_masuk" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      </div>
                      <div class="flex flex-col">
                        <label for="start_tanggal_kedaluwarsa" class="text-sm font-medium text-gray-700">Tanggal Kedaluwarsa Mulai</label>
                        <input type="date" name="start_tanggal_kedaluwarsa" id="start_tanggal_kedaluwarsa" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      </div>
                      <div class="flex flex-col">
                        <label for="end_tanggal_kedaluwarsa" class="text-sm font-medium text-gray-700">Tanggal Kedaluwarsa Akhir</label>
                        <input type="date" name="end_tanggal_kedaluwarsa" id="end_tanggal_kedaluwarsa" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      </div>
                      <div class="flex items-end">
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 w-full sm:w-auto">
                          Ekspor PDF
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="-mx-4 mt-8 sm:-mx-0">
                  <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                      <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Nama</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 xl:table-cell">Stok Masuk</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Tanggal Masuk</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 md:table-cell">Tanggal Kedaluwarsa</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                      @foreach($telur_expired as $telur)
                      <tr>
                        <td class="w-fit max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-0">
                          {{ ucwords($telur->produk->nama_produk) }}

                          <dl class="font-normal lg:hidden">
                            <dt class="sr-only">Nama Produk</dt>
                            <dd class="mt-1 truncate text-gray-700">{{ $telur->stok_masuk }}</dd>
                            <dt class="sr-only sm:hidden">Harga Produk</dt>
                            <dd class="mt-1 truncate text-gray-500 md:hidden">
                              Rp{{ number_format($telur->produk->harga_produk, 0, ',', '.') }}</dd>
                            <dt class="sr-only sm:hidden">Stok Produk</dt>
                            <dd class="mt-1 truncate text-gray-500 lg:hidden">{{ $telur->stok_produk }} Butir</dd>
                          </dl>
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 xl:table-cell">
                          {{ $telur->stok_masuk }}
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">
                          {{ \Carbon\Carbon::parse($telur->tanggal_restok)->format('d M Y') }}
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 md:table-cell">
                          {{ \Carbon\Carbon::parse($telur->tanggal_kedaluwarsa)->format('d M Y') }}
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
  </div>
</body>

</html>