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

            <div class="relative isolate pt-14 min-h-screen">

                <div class="max-w-2xl pt-16 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                        @foreach ($kelolaStok as $kelola)
                            {{-- Card --}}
                            <div class="h-full">
                                <div
                                    class="relative flex flex-col justify-between my-6 bg-white shadow-sm border border-indigo-200 rounded-lg w-96 h-full">
                                    <div class="relative h-56 m-2.5 overflow-hidden text-white rounded-md">
                                        <img src="{{ asset('storage/' . $kelola->produk->foto_produk) }}"
                                            alt="{{ ucwords($kelola->produk->nama_produk) }}." />
                                    </div>
                                    <div class="p-4 justify-self-start h-1/3">
                                        <h6 class="mb-2 text-slate-800 text-xl font-semibold">
                                            {{ ucwords($kelola->produk->nama_produk) }}
                                        </h6>
                                        <p class="text-slate-600 leading-normal font-light line-clamp-3">
                                            {{ $kelola->produk->deskripsi_produk }}
                                        </p>

                                    </div>
                                    <div class="px-4 pb-4 pt-0 mt-2 flex justify-between items-center">
                                        <p class="text-slate-600 leading-normal font-light">
                                            Stok Anda saat ini, <span
                                                class="font-bold">{{ $kelola->stok_produk }}</span>
                                            butir.
                                        </p>
                                        <a href="/grosir/kelola/{{ Str::slug($kelola->produk->nama_produk) }}/update"
                                            class="rounded-md bg-indigo-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                            type="button">
                                            Update Stok
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('components.grosir.footer')
</body>

</html>
