@if (session('success'))
    <!DOCTYPE html>
    <html lang="id" class="h-full bg-gray-50">

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

                    <main class="relative lg:min-h-full mt-8 gap-8">
                        <div class="h-80 lg:absolute lg:h-full lg:w-1/2 lg:pr-4 xl:pr-12">
                            <img src="{{ asset('img/grosir/ringkasan-pesanan/ringkasan-pesanan.png') }}" alt="TODO"
                                class="h-full w-full object-cover object-center">
                        </div>

                        <div>
                            <div
                                class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8 lg:py-32 xl:gap-x-24">
                                <div class="lg:col-start-2">
                                    <h1 class="text-sm font-medium text-indigo-600">Transaksi Berhasil</h1>
                                    <p class="mt-4 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Terima
                                        Kasih atas Pesanan Anda</p>
                                    <p class="mt-4 text-base text-gray-500">Kami menghargai pesanan Anda, saat ini kami
                                        sedang memprosesnya. Silakan tunggu dan kami akan mengirimkan konfirmasi segera!
                                    </p>

                                    @php
                                       $subtotal = 0;
                                       $pengiriman = 0;
                                    @endphp
                                    @foreach ($transaksis as $transaksi)
                                        <ul role="list"
                                            class="mt-6 divide-y divide-gray-200 border-t border-gray-200 text-sm font-medium text-gray-500">
                                            <li class="flex space-x-6 py-6 gap-6">
                                                <img src="{{ asset('storage/' . $transaksi->produk->foto_produk) }}"
                                                    alt="Model mengenakan kaos dasar pria warna arang ukuran besar."
                                                    class="h-24 w-24 flex-none rounded-md bg-gray-100 object-cover object-center">
                                                <div class="flex-auto space-y-1">
                                                    <h3 class="text-gray-900">
                                                        <a
                                                            href="{{ route('grosir.produk.show', ['nama_produk' => Str::slug($transaksi->produk->nama_produk)]) }}">{{ ucwords($transaksi->produk->nama_produk) }}</a>
                                                    </h3>
                                                    <p>
                                                        <span class="select-none text-sm text-gray-400">Jumlah : </span>
                                                        {{ $transaksi->qty }}
                                                    </p>
                                                    </p>
                                                </div>
                                                <p class="flex-none font-medium text-gray-900">
                                                    Rp{{ number_format($transaksi->produk->harga_produk, 0, ',', '.') }}
                                                    <span class="select-none text-sm text-gray-400">/ Butir</span>
                                                </p>
                                            </li>
                                        </ul>
                                        @php
                                           $pengiriman = ($transaksi->jenis_pengiriman == 'darurat' ? 50000 : 20000);
                                           $subtotal += ($transaksi->total_harga - $pengiriman);
                                        @endphp
                                    @endforeach

                                    <dl
                                        class="space-y-6 border-t border-gray-200 pt-6 text-sm font-medium text-gray-500">
                                        <div class="flex justify-between">
                                            <dt>Subtotal</dt>
                                            <dd class="text-gray-900">
                                                Rp{{ number_format($subtotal, 0, ',', '.') }}
                                            </dd>
                                        </div>

                                        <div class="flex justify-between">
                                            <dt>Pengiriman</dt>
                                            <dd class="text-gray-900">
                                                Rp{{ number_format($pengiriman, 0, ',', '.') }}
                                            </dd>
                                        </div>

                                        <div
                                            class="flex items-center justify-between border-t border-gray-200 pt-6 text-gray-900">
                                            <dt class="text-base">Total</dt>
                                            <dd class="text-base">
                                                Rp{{ number_format($subtotal + $pengiriman, 0, ',', '.') }}
                                            </dd>
                                        </div>
                                    </dl>

                                    <dl class="mt-16 grid grid-cols-2 gap-x-4 text-sm text-gray-600">
                                        <div>
                                            <dt class="font-medium text-gray-900">Alamat Pengiriman</dt>
                                            <dd class="mt-2">
                                                <address class="not-italic">
                                                    <span class="block">
                                                        {{ ucwords($transaksi->grosir->nama_grosir) }}
                                                    </span>
                                                    <span class="block">
                                                        {{ $transaksi->grosir->alamat_grosir }}
                                                    </span>
                                                    <span class="block">
                                                        {{ $transaksi->grosir->nomor_telefon_grosir }}
                                                    </span>
                                                </address>
                                            </dd>
                                        </div>
                                    </dl>

                                    <div class="mt-16 border-t border-gray-200 py-6 text-right">
                                        <a href="/grosir/produk"
                                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                            Lanjutkan Belanja
                                            <span aria-hidden="true"> &rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>

                </div>
            </div>
        </div>

        @include('components.grosir.footer')
    </body>

    </html>
@else
    <!-- Redirect menggunakan JavaScript jika tidak ada sesi 'success' -->
    <script type="text/javascript">
        window.location = "{{ url('grosir/pesanan') }}"; // Menggunakan helper 'url' untuk mendapatkan URL yang tepat
    </script>
@endif
