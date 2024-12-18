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

      <div x-data="orderForm()" class="relative isolate pt-14">
        <div class="">
          <div class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Checkout</h2>

            <form class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16"
              method="POST" action="{{ route('grosir.transaksi.checkout') }}" enctype="multipart/form-data">
              @csrf
              @php
              $grosir = \App\Models\Grosir::where('id_user', auth()->user()->id)->first();
              @endphp
              <input type="hidden" name="id_grosir" value="{{ $grosir->id }}">
              <div>
                <div>
                  <h2 class="text-lg font-medium text-gray-900">Informasi Penerima</h2>

                  <div class="mt-4">
                    <label for="nama_produk" class="block text-sm font-medium leading-6 text-gray-900">Nama Grosir</label>
                    <div class="mt-2">
                      <input id="nama_produk" name="nama_produk" type="text" class="block w-full rounded-md bg-gray-200 border-0 py-1.5 text-gray-500 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4 select-none" value="{{ $grosir->nama_grosir }}" disabled>
                      @error('nama_produk')
                      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="mt-10 border-t border-gray-200 pt-10">
                  <h2 class="text-lg font-medium text-gray-900">Informasi Pengiriman</h2>

                  <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">

                    <div class="sm:col-span-2">
                      <label for="alamat_grosir" class="block text-sm font-medium leading-6 text-gray-900">Alamat Grosir</label>
                      <div class="mt-2">
                        <textarea id="alamat_grosir" name="alamat_grosir" rows="3" class="block w-full rounded-md bg-gray-200 border-0 py-1.5 text-gray-500 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled>{{ $grosir->alamat_grosir }}</textarea>
                        @error('alamat_grosir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>

                    <div class="sm:col-span-2">
                      <label for="nomor_telefon_grosir" class="block text-sm font-medium leading-6 text-gray-900">Nomor Telefon</label>
                      <div class="mt-2">
                        <input id="nomor_telefon_grosir" name="nomor_telefon_grosir" type="text" class="block w-full bg-gray-200 rounded-md border-0 py-1.5 text-gray-500 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" value="{{ $grosir->nomor_telefon_grosir }}" disabled>
                        @error('nomor_telefon_grosir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>

                    <div class="col-span-full flex justify-center">
                      <a href="{{ route('grosir.profile') }}" class="py-2 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500">Update</a>
                    </div>
                  </div>
                </div>

                <div class="mt-10 border-t border-gray-200 pt-10">
                  <h2 class="text-lg font-medium text-gray-900">Pengiriman</h2>

                  <fieldset class="mt-4 p-6 bg-gray-50 rounded-lg shadow-sm border border-gray-200">
                    <legend class="sr-only">Plan</legend>
                    <div class="space-y-5">
                      <div class="relative flex items-start">
                        <div class="flex h-6 items-center">
                          <input id="reguler" x-model="jenisPengiriman" name="jenis_pengiriman" type="radio" checked="" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" value="reguler">
                        </div>
                        <div class="ml-3 text-sm leading-6">
                          <label for="reguler" class="font-medium text-gray-900">Reguler</label>
                          <p id="small-description" class="text-gray-500">Rp20.000 - Estimasi 3 - 5 hari</p>
                        </div>
                      </div>
                      <div class="relative flex items-start">
                        <div class="flex h-6 items-center">
                          <input id="darurat" x-model="jenisPengiriman" name="jenis_pengiriman" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" value="darurat">
                        </div>
                        <div class="ml-3 text-sm leading-6">
                          <label for="darurat" class="font-medium text-gray-900">Darurat</label>
                          <p id="medium-description" class="text-gray-500">Rp50.000 - Estimasi 1 hari</p>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  @error('jenis_pengiriman')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Payment -->
                <div class="mt-10 border-t border-gray-200 pt-10">
                  <h2 class="text-lg font-medium text-gray-900">Pembayaran</h2>

                  <fieldset class="mt-4 flex justify-center">
                    <div class="w-1/4">
                      @include('components.grosir.qr-code')
                    </div>
                  </fieldset>

                  <div class="mt-6 grid grid-cols-4 gap-x-4 gap-y-6">
                    <div class="col-span-4">
                      <label for="file-input" class="px-2">Bukti Pembayaran</label>
                      <input type="file" name="bukti_pembayaran" id="file-input" class="mt-4 block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4" accept=".jpeg,.jpg,.png,.pdf">
                    </div>
                  </div>
                  @error('bukti_pembayaran')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <!-- Order summary -->
              <div class="mt-10 lg:mt-0">
                <h2 class="text-lg font-medium text-gray-900">Ringkasan Pesanan</h2>

                <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
                  <ul role="list" class="divide-y divide-gray-200">
                    @foreach($keranjangs as $keranjang)
                    {{-- Id Produk --}}
                    <input type="hidden" name="id_produk[]" value="{{ $keranjang->produk->id }}">
                    <input type="hidden" name="qty[]" value="{{ $keranjang->qty }}">

                    <li class="flex px-4 py-6 sm:px-6">
                      <div class="flex-shrink-0">
                        <img src="{{ asset('storage/'.$keranjang->produk->foto_produk) }}" alt="{{ $keranjang->produk->nama_produk }}." class="w-20 rounded-md">
                      </div>

                      <div class="ml-6 flex flex-1 flex-col">
                        <div class="flex">
                          <div class="min-w-0 flex-1">
                            <h4 class="text-sm">
                              <a href="#" class="font-medium text-gray-700 hover:text-gray-800">{{ ucwords($keranjang->produk->nama_produk) }}</a>
                            </h4>
                            <p class="mt-1 text-sm text-gray-500 line-clamp-2 w-3/4">{{ $keranjang->produk->deskripsi_produk }}</p>
                          </div>
                        </div>

                        <div class="mt-2">
                          <p class="mt-1 text-sm font-medium text-gray-500">Stok: {{ $keranjang->produk->stok_realtime_produk }}</p>
                        </div>

                        <div class="flex flex-1 items-center justify-between pt-2 mt-2">
                          <p class="mt-1 text-sm font-medium text-gray-900">Rp{{ number_format($keranjang->produk->harga_produk, 0, ',', '.') }}
                            <span class="text-gray-400">/ Butir</span>
                          </p>

                          <div class="ml-4">
                            <label for="quantity" class="sr-only">Jumlah</label>
                            <span>{{ $keranjang->qty }}</span>
                          </div>
                        </div>
                        @error('qty')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                      </div>
                    </li>
                    @endforeach
                  </ul>
                  <dl class="space-y-6 border-t border-gray-200 px-4 py-6 sm:px-6">
                    <div class="flex items-center justify-between">
                      <dt class="text-sm">Subtotal</dt>
                      @php
                      $subtotal = 0;

                      foreach($keranjangs as $keranjang) {
                      $subtotal += $keranjang->qty * $keranjang->produk->harga_produk;
                      }
                      @endphp
                      <dd class="text-sm font-medium text-gray-900">Rp{{ number_format($subtotal, 0, ',', '.') }}</span></dd>
                    </div>
                    <div class="flex items-center justify-between">
                      <dt class="text-sm">Pengiriman</dt>
                      <dd class="text-sm font-medium text-gray-900">Rp<span x-text="shippingCost.toLocaleString('id-ID')"></span></dd>
                    </div>
                    <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                      <dt class="text-base font-medium">Total</dt>
                      <dd class="text-base font-medium text-gray-900">Rp<span x-text="total.toLocaleString('id-ID')"></span></dd>
                    </div>
                  </dl>

                  <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                    <button type="submit" class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Konfirmasi Pesanan</button>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Definisikan biaya pengiriman
      const shippingCosts = {
        reguler: 20000,
        darurat: 50000
      };

      // Ambil elemen radio button dan tempat untuk menampilkan hasil
      const radioButtons = document.querySelectorAll('input[name="jenis_pengiriman"]');
      const shippingCostDisplay = document.querySelector('[x-text="shippingCost.toLocaleString(\'id-ID\')"]');
      const totalDisplay = document.querySelector('[x-text="total.toLocaleString(\'id-ID\')"]');

      let subtotal = @php echo($subtotal) @endphp;
      let shippingCost = shippingCosts.reguler;

      // Function untuk update tampilan biaya pengiriman dan total
      function updateTotal() {
        // Update shipping cost di UI
        if (shippingCostDisplay) {
          shippingCostDisplay.textContent = shippingCost.toLocaleString('id-ID');
        }

        // Update total
        let total = subtotal + shippingCost;
        if (totalDisplay) {
          totalDisplay.textContent = total.toLocaleString('id-ID');
        }
      }

      // Tambahkan event listener ke setiap radio button
      radioButtons.forEach((radio) => {
        radio.addEventListener('change', function() {
          shippingCost = shippingCosts[this.value]; // Update biaya pengiriman berdasarkan pilihan
          updateTotal(); // Perbarui total setelah pengiriman berubah
        });
      });

      // Inisialisasi tampilan total saat pertama kali load
      updateTotal();
    });
  </script>
</body>

</html>