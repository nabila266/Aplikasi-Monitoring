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

                <div x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-white">
                    <main class="max-w-2xl px-4 mx-auto mt-8 sm:pb-20 sm:px-6 lg:max-w-7xl lg:px-8">
                        <div class="lg:grid lg:grid-cols-12 lg:gap-x-8">
                            <div class="lg:col-span-5 lg:col-start-8">
                                @if (session('success'))
                                    <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded"
                                        role="alert">
                                        <strong class="font-bold">Sukses!</strong>
                                        <span class="block sm:inline">{{ session('success') }}</span>
                                    </div>
                                @elseif (session('error'))
                                    <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded"
                                         role="alert">
                                        <strong class="font-bold">Kesalahan!</strong>
                                        <span class="block sm:inline">{{ session('error') }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between">
                                    <h1 class="text-xl font-medium text-gray-900">
                                        {{ ucwords($product->nama_produk) }}
                                    </h1>
                                    <p class="text-xl font-medium text-gray-900">
                                        Rp{{ number_format($product->harga_produk, 0, ',', '.') }}
                                    </p>
                                </div>
                              <div>
                                <p class="mt-4 ml-2 text-gray-600 font-medium">
                                  Stok : {{ $product->stok_produk }}
                                </p>
                              </div>
                            </div>

                            <!-- Gambar -->
                            <div class="mt-8 lg:col-span-7 lg:col-start-1 lg:row-span-3 lg:row-start-1 lg:mt-0">
                                <!-- Tombol Kembali -->
                                <div class="mt-4 lg:col-span-7 lg:col-start-1 lg:row-span-3 lg:row-start-1 lg:mt-0">
                                    <a href="/grosir/produk"
                                        class="inline-flex items-center px-4 py-2 text-sm font-semibold text-indigo-500 duration-150 border-2 border-indigo-500 rounded-md shadow-sm hover:border-indigo-700 hover:text-indigo-700">
                                        &larr; Kembali
                                    </a>
                                </div>
                                <h2 class="sr-only">Images</h2>

                                <div class="grid grid-cols-1 lg:gap-8">
                                    <img src="{{ asset('storage/' . $product->foto_produk) }}"
                                        alt="{{ ucwords($product->nama_produk) }}"
                                        class="rounded-lg lg:col-span-2 lg:row-span-2">
                                </div>
                            </div>

                            <div class="mt-8 lg:col-span-5">
                                <form method="POST" action="{{ route('grosir.keranjang.add') }}">
                                    @csrf

                                    <input type="hidden" value="{{ $product->id }}" name="id_produk">

                                    <div class="grid items-center grid-cols-3 gap-8">
                                        <div class="relative rounded-md shadow-sm">
                                            <input type="text" name="qty" id="qty"
                                                class="block w-full rounded-md border-0 py-1.5 pl-4 pr-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                placeholder="0" aria-describedby="price-currency" min="1">
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm" id="price-currency">Butir</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-4">
                                            <span class="mr-2 text-gray-300 select-none">|</span>
                                            <a href="{{ route('grosir.keranjang') }}">
                                                <svg class="duration-150 fill-gray-900 hover:fill-gray-500"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" style="transform: ;msFilter:;">
                                                    <path
                                                        d="M21 4H2v2h2.3l3.28 9a3 3 0 0 0 2.82 2H19v-2h-8.6a1 1 0 0 1-.94-.66L9 13h9.28a2 2 0 0 0 1.92-1.45L22 5.27A1 1 0 0 0 21.27 4 .84.84 0 0 0 21 4zm-2.75 7h-10L6.43 6h13.24z">
                                                    </path>
                                                    <circle cx="10.5" cy="19.5" r="1.5"></circle>
                                                    <circle cx="16.5" cy="19.5" r="1.5"></circle>
                                                </svg>
                                            </a>
                                            @if (!$wishlist)
                                                <button type="button" id="wishlist-button-add">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24"
                                                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                        <path
                                                            d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            @else
                                                <button type="button" id="wishlist-button-remove">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24"
                                                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                        <path
                                                            d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    @error('qty')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    <!-- Tombol Keranjang -->
                                    <button type="submit"
                                        class="flex items-center justify-center w-full px-8 py-3 mt-4 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        + Keranjang
                                    </button>

                                    <!-- Tombol Beli Sekarang -->
                                    <a href="{{ route('grosir.produk.beli-sekarang', ['nama_produk' => Str::slug($product->nama_produk)]) }}"
                                        class="flex items-center justify-center w-full px-8 py-3 mt-4 text-base font-medium text-indigo-600 bg-transparent border border-indigo-600 rounded-md hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Beli Sekarang
                                    </a>
                                </form>

                                @if (!$wishlist)
                                    <form id="wishlist-form-add" method="POST"
                                        action="{{ route('grosir.produk.wishlist.add') }}" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="id_grosir"
                                            value="{{ \App\Models\Grosir::where('id_user', Auth::user()->id)->first()->id }}">
                                        <input type="hidden" name="id_produk" value="{{ $product->id }}">
                                    </form>
                                @else
                                    <form id="wishlist-form-remove" method="POST"
                                        action="{{ route('grosir.produk.wishlist.remove') }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id_produk" value="{{ $wishlist->id_produk }}">
                                    </form>
                                @endif

                                <!-- Detail Produk -->
                                <div class="mt-10">
                                    <h2 class="text-sm font-medium text-gray-900">Deskripsi</h2>

                                    <div class="mt-4 prose-sm prose text-gray-500">
                                        <p>
                                            {{ $product->deskripsi_produk }}
                                        </p>
                                    </div>
                                </div>

                                <div class="pt-8 mt-8 border-t border-gray-200">
                                    <h2 class="text-sm font-medium text-gray-900">Informasi Telur</h2>

                                    <div class="mt-4 prose-sm prose text-gray-500">
                                        <ul role="list" class="space-y-2 list-disc list-inside">
                                            <li class="flex items-start">
                                                <span class="w-4 h-4 mr-2 bg-gray-300 rounded-full"></span>
                                                Hanya menggunakan telur segar dari peternakan terpercaya
                                            </li>
                                            <li class="flex items-start">
                                                <span class="w-4 h-4 mr-2 bg-gray-300 rounded-full"></span>
                                                Dikemas dengan standar kebersihan tinggi
                                            </li>
                                            <li class="flex items-start">
                                                <span class="w-4 h-4 mr-2 bg-gray-300 rounded-full"></span>
                                                Periksa tanggal kedaluwarsa sebelum digunakan
                                            </li>
                                            <li class="flex items-start">
                                                <span class="w-4 h-4 mr-2 bg-gray-300 rounded-full"></span>
                                                Simpan di kulkas pada suhu 4°C atau lebih rendah
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Kebijakan -->
                                <section aria-labelledby="policies-heading" class="mt-10">
                                    <h2 id="policies-heading" class="sr-only">Informasi Kebijakan</h2>

                                    <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
                                        <div class="p-6 text-center border border-gray-200 rounded-lg bg-gray-50">
                                            <dt>
                                                <svg class="flex-shrink-0 w-6 h-6 mx-auto text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 8.25a3.75 3.75 0 117.5 0v1.5a3.75 3.75 0 117.5 0v-1.5a3.75 3.75 0 113.75 3.75h-1.5a3.75 3.75 0 00-3.75-3.75v1.5a3.75 3.75 0 00-3.75 3.75h-1.5A3.75 3.75 0 015 8.25v-1.5z">
                                                    </path>
                                                </svg>
                                                <span class="mt-4 text-sm font-medium text-gray-900">Pengiriman
                                                    Segar</span>
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-500">Kirimkan telur dalam kondisi segar
                                                langsung dari peternakan</dd>
                                        </div>
                                        <div class="p-6 text-center border border-gray-200 rounded-lg bg-gray-50">
                                            <dt>
                                                <svg class="flex-shrink-0 w-6 h-6 mx-auto text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 4.5h18v15H3V4.5zM5.25 7.5v2.25h13.5V7.5H5.25zm0 3.75v2.25h13.5v-2.25H5.25zm0 3.75v2.25h13.5v-2.25H5.25z">
                                                    </path>
                                                </svg>
                                                <span class="mt-4 text-sm font-medium text-gray-900">Penyimpanan yang
                                                    Tepat</span>
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-500">Simpan telur di suhu yang tepat
                                                untuk menjaga kesegaran</dd>
                                        </div>
                                    </dl>
                                </section>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>

    @include('components.grosir.footer')

    <script>
        @if (!$wishlist)
            document.getElementById('wishlist-button-add').addEventListener('click', function() {
                document.getElementById('wishlist-form-add').submit();
            });
        @else
            document.getElementById('wishlist-button-remove').addEventListener('click', function() {
                document.getElementById('wishlist-form-remove').submit();
            });
        @endif

        document.getElementById('qty').addEventListener('input', function(event) {
            const qtyInput = event.target;
            qtyInput.value = qtyInput.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>

</html>
