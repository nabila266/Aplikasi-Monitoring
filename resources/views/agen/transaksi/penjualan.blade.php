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

        <div x-show="open" class="relative z-50 lg:hidden"
            x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog"
            aria-modal="true">

            <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80"
                x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state."></div>


            <div class="fixed inset-0 flex">

                <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                    class="relative mr-16 flex w-full max-w-xs flex-1" @click.away="open = false">

                    <div x-show="open" x-transition:enter="ease-in-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        x-description="Close button, show/hide based on off-canvas menu state."
                        class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button type="button" class="-m-2.5 p-2.5" @click="open = false">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
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
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                </svg>
            </button>
            <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">Dashboard</div>
            <a href="#">
                <span class="sr-only">Your profile</span>
                <img class="h-8 w-8 rounded-full bg-gray-50"
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                    alt="">
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
                                        <h1 class="text-base font-semibold leading-6 text-gray-900">Penjualan</h1>
                                        <p class="mt-2 text-sm text-gray-700">Detail dari transaksi penjualan termasuk
                                            nomor faktur, produk, jumlah, dan total harga.</p>
                                    </div>
                                </div>
                                <div class="sm:flex sm:items-center">
                                    <div class="sm:flex-auto">
                                        <form action="{{ route('transaksi.exportPenjualan') }}" method="GET"
                                            class="flex flex-col mt-4 sm:flex-row sm:items-end sm:space-x-4 space-y-4 sm:space-y-0">
                                            <div class="flex flex-col sm:flex-1">
                                                <label for="start_date"
                                                    class="text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                                <input type="date" name="start_date" id="start_date" required
                                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>
                                            <div class="flex flex-col sm:flex-1">
                                                <label for="end_date" class="text-sm font-medium text-gray-700">Tanggal
                                                    Akhir</label>
                                                <input type="date" name="end_date" id="end_date" required
                                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            </div>
                                            <div class="flex sm:flex-none">
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full sm:w-auto">
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
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                                    No Faktur</th>
                                                <th scope="col"
                                                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                                    Produk</th>
                                                <th scope="col"
                                                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                                                    Total Harga</th>
                                                <th scope="col"
                                                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                                                    Jumlah</th>
                                                <th scope="col"
                                                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 custom:table-cell">
                                                    Jenis Pengiriman</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Lihat Bukti
                                                </th>
                                                <th scope="col"
                                                    class="sr-only px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @forelse($transaksiGrouped as $transaksi)
                                                <tr>
                                                    <td
                                                        class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-0">
                                                        {{ $transaksi->no_faktur }}
                                                    </td>
                                                    <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">
                                                        @php
                                                            // Ambil semua produk terkait no_faktur
                                                            $produks = \App\Models\Transaksi::where(
                                                                'no_faktur',
                                                                $transaksi->no_faktur,
                                                            )->get();
                                                            // Gabungkan nama produk menjadi satu string dipisahkan dengan koma
                                                            $produkNames = $produks
                                                                ->pluck('produk.nama_produk')
                                                                ->map(fn($nama) => ucwords($nama))
                                                                ->join(', ');
                                                        @endphp

                                                        {{ \Illuminate\Support\Str::limit($produkNames, 30) }}
                                                    </td>
                                                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                        Rp{{ number_format($transaksi->total_harga + ($transaksi->jenis_pengiriman == 'darurat' ? '50000' : '20000'), 0, ',', '.') }}
                                                    </td>
                                                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                        {{ $transaksi->total_qty }}</td>
                                                    <td
                                                        class="hidden px-3 py-4 text-sm text-gray-500 custom:table-cell">
                                                        {{ ucwords($transaksi->jenis_pengiriman) }}
                                                    </td>
                                                    <td class="px-3 py-4 text-sm text-gray-500">
                                                        <a href="/agen/download-bukti/{{ $transaksi->no_faktur }}"
                                                            class="text-indigo-600 hover:text-indigo-900">
                                                            Lihat Bukti
                                                        </a>
                                                    </td>
                                                    <td class="px-3 py-4 text-sm text-gray-500">
                                                        @if ($transaksi->status == 'pending')
                                                            <span class="isolate inline-flex rounded-md shadow-sm">
                                                                <form action="{{ route('agen.transaksi.terima') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="no_faktur"
                                                                        value="{{ $transaksi->no_faktur }}">
                                                                    <button type="submit"
                                                                        class="relative inline-flex items-center rounded-l-md bg-green-600 px-3 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300 hover:bg-green-500 focus:z-10">Proses</button>
                                                                </form>
                                                                <form action="{{ route('agen.transaksi.tolak') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="no_faktur"
                                                                        value="{{ $transaksi->no_faktur }}">
                                                                    <button type="submit"
                                                                        class="relative -ml-px inline-flex items-center rounded-r-md bg-red-600 px-3 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300 hover:bg-red-500 focus:z-10">Tolak</button>
                                                                </form>
                                                            </span>
                                                        @elseif($transaksi->status == 'berhasil')
                                                            <span
                                                                class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Diproses</span>
                                                        @elseif($transaksi->status == 'gagal')
                                                            <span
                                                                class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800">Ditolak</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4 text-sm text-gray-500">
                                                        Tidak ada transaksi ditemukan.</td>
                                                </tr>
                                            @endforelse
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
                                    <p class="mt-2 text-sm text-gray-700">Detail dari transaksi penjualan.</p>
                                </div>

                                <div class="flex flex-col">
                                    <div class="-m-1.5 overflow-x-auto">
                                        <div class="p-1.5 min-w-full inline-block align-middle">
                                            <div class="overflow-hidden">
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-start text-xs font-medium text-gray-900">
                                                                Nama Produk</th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-start text-xs font-medium text-gray-900">
                                                                Total Stok Terjual</th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-start text-xs font-medium text-gray-900">
                                                                Total Penjualan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200">

                                                        @php
                                                            $transaksiGrouped = \App\Models\Transaksi::with('produk')
                                                                ->selectRaw('id_produk, SUM(qty) as qty')
                                                                ->selectRaw(
                                                                    'id_produk, SUM(total_harga) as total_harga',
                                                                )
                                                                ->groupBy('id_produk')
                                                                ->get();
                                                        @endphp

                                                        @foreach ($transaksiGrouped as $transaksi)
                                                            <tr>
                                                                <td
                                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 capitalize">
                                                                    {{ $transaksi->produk->nama_produk }}</td>
                                                                <td
                                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                                    {{ $transaksi->qty }}</td>
                                                                <td
                                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                                    {{ $transaksi->total_harga }}</td>
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

    </div>
</body>

</html>