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


                <div class="max-w-2xl pt-16 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8 flex justify-center">
                    {{-- pesan sukses atau error dibawah sini --}}

                    <div class="flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg my-6 w-96">
                        <div class="mb-4">
                            @if (session('success'))
                                <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded relative"
                                    role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="bg-red-100 border border-red-500 text-red-700 px-4 py-3 rounded relative"
                                    role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="m-2.5 overflow-hidden rounded-md h-80 flex justify-center items-center">
                            <img class="w-full h-full object-cover"
                                src="{{ asset('storage/' . $kelola->produk->foto_produk) }}"
                                alt="{{ ucwords($kelola->produk->nama_produk) }}." />
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="mb-1 text-xl font-semibold text-slate-800">
                                {{ ucwords($kelola->produk->nama_produk) }}
                            </h4>
                            <p class="text-sm text-slate-500 capitalize">
                                Stok Anda saat ini, <span class="font-semibold">{{ $kelola->stok_produk }}</span>
                            </p>
                            <p class="text-base text-slate-600 mt-4 font-light line-clamp-3">
                                {{ $kelola->produk->deskripsi_produk }}
                            </p>
                        </div>
                        <div class="flex justify-center p-6 pt-2 gap-7">
                            <form action="{{ route('grosir.kelola.update') }}" class="flex flex-col" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $kelola->id }}">
                                <div class="py-2 px-3 bg-gray-100 rounded-lg dark:bg-neutral-700 mb-4"
                                    data-hs-input-number="">
                                    <div class="w-full flex justify-between items-center gap-x-5">
                                    <div class="grow">
                                        <input
                                            class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white"
                                            style="-moz-appearance: textfield;" type="number"
                                            aria-roledescription="Number field" value="{{ $kelola->stok_produk }}"
                                            data-hs-input-number-input="" name="stok_produk">
                                        </div>
                                        @if($errors->has('stok_produk'))
                                            <span class="text-red-500 text-sm">{{ $errors->first('stok_produk') }}</span>
                                        @endif
                                        <div class="flex justify-end items-center gap-x-1.5">
                                            <button type="button"
                                                class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                                tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                </svg>
                                            </button>
                                            <button type="button"
                                                class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                                tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                    <path d="M12 5v14"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="min-w-32 rounded-md bg-indigo-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none self-end">
                                    Update Stok
                                </button>
                                <a href="/grosir/produk/detail/{{ Str::slug($kelola->produk->nama_produk) }}"
                                    class="min-w-32 rounded-md border border-indigo-600 py-2 px-4 text-center text-sm text-indigo transition-all bg-white focus:shadow-none hover:border-indigo-700 hover:bg-indigo-50 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none w-full mt-4">
                                    Tammbah Stok
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.grosir.footer')

    <script>
        const inputNumber = document.querySelector('[data-hs-input-number-input]');
        const decrementButton = document.querySelector('[data-hs-input-number-decrement]');
        const incrementButton = document.querySelector('[data-hs-input-number-increment]');

        decrementButton.addEventListener('click', () => {
            const currentValue = parseInt(inputNumber.value);
            if (currentValue > 0) {
                inputNumber.value = currentValue - 1;
            }
        });

        incrementButton.addEventListener('click', () => {
            const currentValue = parseInt(inputNumber.value);
            if (currentValue < {{ $kelola->stok_produk }}) {
                inputNumber.value = currentValue + 1;
            }
        });
    </script>
</body>

</html>
