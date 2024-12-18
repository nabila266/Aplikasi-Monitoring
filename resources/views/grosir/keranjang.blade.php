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

                <div class="bg-white min-h-screen">
                    <div class="max-w-2xl px-4 py-16 mx-auto sm:px-6 sm:py-24 lg:px-0">
                        <h1 class="text-3xl font-bold tracking-tight text-center text-gray-900 sm:text-4xl">Keranjang
                            Belanja</h1>

                        <form class="mt-12">
                            <section aria-labelledby="cart-heading">
                                <h2 id="cart-heading" class="sr-only">Barang dalam keranjang belanja Anda</h2>

                                <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">

                                    @foreach ($keranjangs as $keranjang)
                                        <li class="flex py-6">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('storage/'.$keranjang->produk->foto_produk) }}"
                                                    alt="{{ $keranjang->produk->deskripsi_produk }}."
                                                    class="object-cover object-center w-24 h-24 rounded-md sm:h-32 sm:w-32 line-clamp-5">
                                            </div>

                                            <div class="flex flex-col flex-1 ml-4 sm:ml-6">
                                                <div>
                                                    <div class="flex justify-between">
                                                        <h4 class="text-sm">
                                                            <a href="#"
                                                                class="font-medium text-gray-700 hover:text-gray-800">
                                                                {{ ucwords($keranjang->produk->nama_produk) }}
                                                            </a>
                                                        </h4>
                                                        <p
                                                            class="ml-4 text-sm font-medium text-gray-900 flex flex-col items-end">
                                                            <span>
                                                                Rp{{ number_format($keranjang->produk->harga_produk * $keranjang->qty, 0, ',', '.') }}
                                                            </span>
                                                            <span class="select-none text-sm text-gray-400 mt-2">
                                                                {{ $keranjang->qty }} Butir
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <p class="mt-1 text-sm text-gray-500 line-clamp-2 w-1/2">
                                                        {{ $keranjang->produk->deskripsi_produk }}
                                                    </p>
                                                </div>

                                                <div class="flex items-end justify-between flex-1 mt-4">
                                                    @if ($keranjang->produk->status == 'tersedia')
                                                        <p class="flex items-center space-x-2 text-sm text-gray-700">
                                                            <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                                                viewBox="0 0 20 20" fill="currentColor"
                                                                aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span>Stok Tersedia</span>
                                                        @else
                                                        <p class="flex items-center space-x-2 text-sm text-gray-700">
                                                            <svg class="flex-shrink-0 w-5 h-5 text-green-500"
                                                                viewBox="0 0 20 20" fill="currentColor"
                                                                aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span>Stok Tidak Tersedia</span>
                                                    @endif
                                                    </p>
                                                    <div class="ml-4">
                                                        <form method="POST"
                                                            action="{{ route('grosir.keranjang.hapus') }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id"
                                                                value="{{ $keranjang->id }}">
                                                            <button type="submit"
                                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                                                Hapus
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>

                            <!-- Ringkasan pesanan -->
                            <section aria-labelledby="summary-heading" class="mt-10">
                                <h2 id="summary-heading" class="sr-only">Ringkasan pesanan</h2>

                                <div>
                                    <dl class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <dt class="text-base font-medium text-gray-900">Subtotal</dt>
                                            <dd class="ml-4 text-base font-medium text-gray-900">
                                                Rp{{ number_format($subtotal, 0, ',', '.') }}
                                            </dd>
                                        </div>
                                    </dl>
                                    <p class="mt-1 text-sm text-gray-500">Biaya pengiriman akan dihitung saat checkout.
                                    </p>
                                </div>

                                <div class="mt-10 w-full text-center">
                                    <a href="/grosir/produk/beli"
                                        class=" px-4 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Checkout</a>
                                </div>

                                <div class="mt-6 text-sm text-center">
                                    <p>
                                        atau
                                        <a href="/grosir/produk"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Lanjutkan Belanja
                                            <span aria-hidden="true"> →</span>
                                        </a>
                                    </p>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.grosir.footer')
</body>

</html>
