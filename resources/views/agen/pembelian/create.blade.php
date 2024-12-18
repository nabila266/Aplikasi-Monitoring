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
          <div class="bg-yellow-50 p-4">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm text-yellow-700">
                  Mohon diperhatikan, pengisian pada kolom Deskripsi Produk, Harga Jual Produk, dan Foto Produk hanya akan memperbarui data jika opsi "Pilih Produk" yang sudah ada dipilih.
                </p>
              </div>
            </div>
          </div>
          <div class="bg-white py-10">
            <div class="mx-auto max-w-7xl">

              <div class="relative flex justify-center overflow-hidden rounded-xl">
                <form class="w-screen max-w-screen-md bg-white shadow-sm p-8 rounded-xl" action="/agen/transaksi/pembelian/tambah/" method="POST" enctype="multipart/form-data">
                  @csrf

                  <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

                  <div class="space-y-12">
                    <div class="pb-12 border-b border-gray-900/10">
                      <h2 class="text-xl font-semibold leading-7 text-gray-900">Pembelian Produk</h2>
                      <p class="mt-1 text-sm leading-6 text-gray-600"></p>

                      <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">

                        <div class="sm:col-span-full">
                          <label for="no_faktur" class="block text-sm font-medium leading-6 text-gray-900">No Faktur</label>
                          <div class="mt-2">
                            <input id="no_faktur" name="no_faktur" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="Masukkan no faktur...">
                            @error('no_faktur')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>

                        <div class="sm:col-span-full flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                          <div>
                            <label for="nama_produk" class="block text-sm font-medium leading-6 text-gray-900">Pilih Produk</label>
                            <div class="mt-2">
                              <select id="select-produk" name="select-produk" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                <option value="">Pilih produk yang sudah ada...</option>
                                @foreach($produk as $item)
                                <option value="{{ $item->id }}">{{ ucwords($item->nama_produk) }}</option>
                                @endforeach
                              </select>
                              @error('select-produk')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>

                          <span class=" select-none text-gray-400 text-center">
                            atau
                          </span>

                          <div>
                            <label for="nama_produk_baru" class="block text-sm font-medium leading-6 text-gray-900">Nama Produk Baru</label>
                            <div class="mt-2">
                              <input id="nama_produk_baru" name="nama_produk_baru" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="Masukkan nama produk baru...">
                              @error('nama_produk_baru')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="sm:col-span-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
                          <div>
                            <label for="harga_beli" class="block text-sm font-medium leading-6 text-gray-900">Harga Beli Produk
                              <span class="text-gray-400 select-none">(IDR)</span>
                            </label>
                            <div class="mt-2">
                              <input id="harga_beli" name="harga_beli" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="0">
                              @error('harga_beli')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                          <div>
                            <label for="stok_produk" class="block text-sm font-medium leading-6 text-gray-900">Jumlah Pembelian
                              <span class="text-gray-400 select-none">(Butir)</span>
                            </label>
                            <div class="mt-2">
                              <input id="stok_produk" name="stok_produk" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="0">
                              @error('stok_produk')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                          <div>
                            <label for="biaya_pemesanan" class="block text-sm font-medium leading-6 text-gray-900">Biaya Pemesanan
                              <span class="text-gray-400 select-none">(Butir)</span>
                            </label>
                            <div class="mt-2">
                              <input id="biaya_pemesanan" name="biaya_pemesanan" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="0">
                              @error('biaya_pemesanan')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="col-span-full">
                          <label for="deskripsi_produk" class="block text-sm font-medium leading-6 text-gray-900">Deskripsi Produk</label>
                          <div class="mt-2">
                            <textarea id="deskripsi_produk" name="deskripsi_produk" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4"></textarea>
                            @error('deskripsi_produk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>

                        <div class="sm:col-span-full grid md:grid-cols-2 grid-cols-1 gap-4">
                          <div>
                            <label for="harga_produk" class="block text-sm font-medium leading-6 text-gray-900">Harga Jual Produk
                              <span class="text-gray-400 select-none">(IDR)</span>
                            </label>
                            <div class="mt-2">
                              <input id="harga_produk" name="harga_produk" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="0">
                              @error('harga_produk')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                          <div>
                            <label for="tanggal_kedaluwarsa" class="block text-sm font-medium leading-6 text-gray-900">Lama Kedaluwarsa
                              <span class="text-gray-400 select-none">(Jumlah Hari)</span>
                            </label>
                            <div class="mt-2">
                              <input id="tanggal_kedaluwarsa" name="tanggal_kedaluwarsa" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" placeholder="Contoh: 30">
                              @error('tanggal_kedaluwarsa')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="col-span-full">
                          <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Foto Produk</label>
                          <div class="flex justify-center px-6 py-10 mt-2 border border-dashed rounded-lg border-gray-900/25">
                            <div class="text-center relative">
                              <svg class="w-12 h-12 mx-auto text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                              </svg>
                              <div class="flex mt-4 text-sm leading-6 text-gray-600">
                                <label for="foto_produk" class="relative font-semibold text-indigo-600 bg-white rounded-md cursor-pointer focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                  <span>Unggah file</span>
                                  <input id="foto_produk" name="foto_produk" type="file" class="sr-only" accept="image/*" onchange="tampilkanInfoFile()">
                                </label>
                                <p class="pl-1">atau seret dan jatuhkan</p>
                              </div>
                              <p id="file-info" class="text-xs leading-5 text-gray-600">PNG, JPG, GIF maksimal 10MB</p>
                              <p id="file-error" class="mt-2 text-sm text-red-600 hidden">Ukuran file melebihi 2MB.</p>

                              <!-- Tempat untuk pratinjau gambar dan tombol hapus -->
                              <div id="image-preview-container" class="relative mt-4 hidden group mx-auto w-fit">
                                <img id="image-preview" src="" alt="Pratinjau Gambar" class="w-32 h-32 object-cover rounded-lg shadow-lg">
                                <button id="delete-button" type="button" onclick="hapusFile()" class="absolute inset-0 flex items-center justify-center text-white bg-black bg-opacity-50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @error('foto_produk')
                      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-x-6">
                      <a href="/agen/pembelian/" class="px-3 py-2 text-sm font-semibold text-gray-500 border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Kembali</a>
                      <button type="submit" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
                    </div>
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
    document.getElementById('harga_produk').addEventListener('input', function(event) {
      const hargaProdukInput = event.target;
      hargaProdukInput.value = hargaProdukInput.value.replace(/[^0-9]/g, '');
    });
    document.getElementById('stok_produk').addEventListener('input', function(event) {
      const stokProdukInput = event.target;
      stokProdukInput.value = stokProdukInput.value.replace(/[^0-9]/g, '');
    });
    document.getElementById('tanggal_kedaluwarsa').addEventListener('input', function(event) {
      const tanggalKedaluwarsaInput = event.target;
      tanggalKedaluwarsaInput.value = tanggalKedaluwarsaInput.value.replace(/[^0-9]/g, '');
    });
    document.getElementById('rop_produk').addEventListener('input', function(event) {
      const ropProdukInput = event.target;
      ropProdukInput.value = ropProdukInput.value.replace(/[^0-9]/g, '');
    });
    document.getElementById('lead_time_produk').addEventListener('input', function(event) {
      const leadTimeProdukInput = event.target;
      leadTimeProdukInput.value = leadTimeProdukInput.value.replace(/[^0-9]/g, '');
    });
    document.getElementById('safety_stock_produk').addEventListener('input', function(event) {
      const safetyStockProdukInput = event.target;
      safetyStockProdukInput.value = safetyStockProdukInput.value.replace(/[^0-9]/g, '');
    });

    function tampilkanInfoFile() {
      const fileInput = document.getElementById('foto_produk');
      const fileInfo = document.getElementById('file-info');
      const fileError = document.getElementById('file-error');
      const imagePreviewContainer = document.getElementById('image-preview-container');
      const imagePreview = document.getElementById('image-preview');

      if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const ukuranFileMB = (file.size / (1024 * 1024)).toFixed(2);

        if (file.size > 2 * 1024 * 1024) { // 2MB dalam byte
          fileError.classList.remove('hidden');
          imagePreviewContainer.classList.add('hidden');
          fileInfo.textContent = "PNG, JPG, GIF maksimal 10MB";
        } else {
          fileError.classList.add('hidden');
          fileInfo.textContent = `File: ${file.name}, Ukuran: ${ukuranFileMB} MB, Tipe: ${file.type}`;

          // Pratinjau gambar
          const reader = new FileReader();
          reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreviewContainer.classList.remove('hidden');
          }
          reader.readAsDataURL(file);
        }
      } else {
        fileInfo.textContent = "PNG, JPG, GIF maksimal 10MB";
        fileError.classList.add('hidden');
        imagePreviewContainer.classList.add('hidden');
      }
    }

    function hapusFile() {
      const fileInput = document.getElementById('foto_produk');
      const fileInfo = document.getElementById('file-info');
      const fileError = document.getElementById('file-error');
      const imagePreviewContainer = document.getElementById('image-preview-container');
      const imagePreview = document.getElementById('image-preview');

      // Reset input file
      fileInput.value = "";

      // Sembunyikan pratinjau gambar dan pesan error
      imagePreviewContainer.classList.add('hidden');
      fileError.classList.add('hidden');

      // Reset teks informasi file
      fileInfo.textContent = "PNG, JPG, GIF maksimal 10MB";
    }

    document.addEventListener('DOMContentLoaded', function() {
      const selectProduk = document.getElementById('select-produk');
      const namaProdukBaruInput = document.getElementById('nama_produk_baru');

      if (selectProduk) {
        selectProduk.addEventListener('input', function() {
          if (this.value !== '0') {
            namaProdukBaruInput.value = ''; // Reset inputan Nama Produk Baru ketika produk dipilih dari select
          }
        });
      }

      if (namaProdukBaruInput) {
        namaProdukBaruInput.addEventListener('input', function() {
          if (this.value !== '') {
            selectProduk.value = '0'; // Reset select produk ke value 0 ketika Nama Produk Baru diisi
          }
        });
      }
    });
  </script>
</body>

</html>