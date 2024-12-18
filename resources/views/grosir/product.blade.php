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
        <div class="">

          <div x-data="{ open: false }" @keydown.window.escape="open = false">
            <!-- Mobile filter dialog -->

            <main>
              <div class="bg-white">
                <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 bpr">
                  <h1 class="text-3xl font-bold tracking-tight text-gray-900">Produk Kami</h1>
                  <p class="mt-4 max-w-3xl text-sm text-gray-700">Berikut adalah berbagai pilihan telur berkualitas dari agen kami, yang siap memenuhi kebutuhan dapur Anda. Temukan berbagai jenis telur, dari telur ayam ras hingga telur berkualitas tinggi lainnya, semuanya dipilih dengan cermat untuk memastikan kesegaran dan nutrisinya. Segera pilih dan beli sebelum stok kami habis!</p>
                </div>
              </div>

              <!-- Product grid -->
              <section aria-labelledby="products-heading" class="mx-auto max-w-2xl px-4 pb-16 pt-12 sm:px-6 sm:pb-24 sm:pt-16 lg:max-w-7xl lg:px-8">
                <h2 id="products-heading" class="sr-only">Products</h2>

                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

                  @foreach($products as $product)
                  <a href="
                {{ route('grosir.produk.show', ['nama_produk' => Str::slug($product->nama_produk) ]) }}
                " class="group">
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                      <img src="{{ asset('storage/'.$product->foto_produk) }}" alt="{{ ucwords($product->nama_produk) }}." class="h-[250px] w-full object-cover object-center group-hover:opacity-75">
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700">{{ ucwords($product->nama_produk) }}</h3>
                    <p class="mt-1 text-lg font-medium text-gray-900">
                      Rp{{ number_format($product->harga_produk, 0, ',', '.') }}
                      <span class="select-none text-sm text-gray-400">/ Butir</span>
                    </p>
                  </a>
                  @endforeach

                </div>
              </section>
            </main>

          </div>
        </div>
      </div>

    </div>
  </div>

  @include('components.grosir.footer')
</body>

</html>