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

              <div class="relative flex justify-center overflow-hidden rounded-xl">
                <form class="w-screen max-w-screen-md bg-white shadow-sm p-8 rounded-xl" action="{{ route('agen.jit.tambah') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="space-y-12">
                    <div class="pb-12 border-b border-gray-900/10">
                      <h2 class="text-xl font-semibold leading-7 text-gray-900">Tambah Produk</h2>
                      <p class="mt-1 text-sm leading-6 text-gray-600"></p>

                      <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">

                        <div class="sm:col-span-full grid md:grid-cols-2 grid-cols-1 gap-4">
                          <div>
                            <label for="kuantitas_pemesanan" class="block text-sm font-medium leading-6 text-gray-900">
                              Kuantitas Pemesanan
                            </label>
                            <div class="mt-2">
                              <input id="kuantitas_pemesanan" name="kuantitas_pemesanan" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="0">
                              @error('kuantitas_pemesanan')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                          <div>
                            <label for="rata_rata_target_persediaan" class="block text-sm font-medium leading-6 text-gray-900">
                              Rata Rata Target Persediaan
                            </label>
                            <div class="mt-2">
                              <input id="rata_rata_target_persediaan" name="rata_rata_target_persediaan" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="0">
                              @error('rata_rata_target_persediaan')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                          <div>
                            <label for="biaya_pemesanan_per_unit" class="block text-sm font-medium leading-6 text-gray-900">
                              Biaya Pemesanan Per Unit
                            </label>
                            <div class="mt-2">
                              <input id="biaya_pemesanan_per_unit" name="biaya_pemesanan_per_unit" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="0">
                              @error('biaya_pemesanan_per_unit')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                          <div>
                            <label for="jumlah_kebutuhan_bahan_baku_tahunan" class="block text-sm font-medium leading-6 text-gray-900">
                              Jumlah Kebutuhan Bahan Baku Tahunan
                            </label>
                            <div class="mt-2">
                              <input id="jumlah_kebutuhan_bahan_baku_tahunan" name="jumlah_kebutuhan_bahan_baku_tahunan" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="0">
                              @error('jumlah_kebutuhan_bahan_baku_tahunan')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                          <div>
                            <label for="biaya_penyimpanan_per_unit" class="block text-sm font-medium leading-6 text-gray-900">
                              Biaya Penyimpanan Per Unit
                            </label>
                            <div class="mt-2">
                              <input id="biaya_penyimpanan_per_unit" name="biaya_penyimpanan_per_unit" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="0">
                              @error('biaya_penyimpanan_per_unit')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-x-6">
                      <a href="/agen/produk/jit" class="px-3 py-2 text-sm font-semibold text-gray-500 border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Kembali</a>
                      <button type="submit" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
                    </div>
                  </div>
                </form>
              </div>

              <hr>

              <div class="relative flex justify-center overflow-hidden rounded-xl">
                <form action="{{ route('produk.jit.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                  @csrf
                  <div class="flex flex-col space-y-4">
                    <label for="file" class="text-sm font-medium text-gray-700">Upload File Excel</label>
                    <input type="file" name="file" id="file" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Import Data
                    </button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  </div>

  <script>
    document.getElementById('kuantitas_pemesanan').addEventListener('input', function(event) {
      const inputKuantitas = event.target;
      inputKuantitas.value = inputKuantitas.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('rata_rata_target_persediaan').addEventListener('input', function(event) {
      const inputTargetPersediaan = event.target;
      inputTargetPersediaan.value = inputTargetPersediaan.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('biaya_pemesanan_per_unit').addEventListener('input', function(event) {
      const inputBiayaPemesanan = event.target;
      inputBiayaPemesanan.value = inputBiayaPemesanan.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('jumlah_kebutuhan_bahan_baku_tahunan').addEventListener('input', function(event) {
      const inputKebutuhanBahan = event.target;
      inputKebutuhanBahan.value = inputKebutuhanBahan.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('biaya_penyimpanan_per_unit').addEventListener('input', function(event) {
      const inputBiayaPenyimpanan = event.target;
      inputBiayaPenyimpanan.value = inputBiayaPenyimpanan.value.replace(/[^0-9]/g, '');
    });
  </script>
</body>

</html>