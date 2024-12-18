<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Wishlist Grosir</title>

  @vite('resources/css/app.css')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full">
  <div class="overflow-hidden">
    <div class="bg-white">
      @include('components.grosir.navbar')

      <div class="relative isolate pt-14">
        <div class="bg-white">
          <div class="max-w-2xl px-4 py-8 mx-auto sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-8">Produk Favorit Anda</h2>
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
              @forelse($wishlistsWithProducts as $item)
              <div class="group">
                <div class="relative w-full overflow-hidden bg-gray-200 rounded-lg aspect-h-1 aspect-w-1 xl:aspect-h-8 xl:aspect-w-7">
                  <img src="{{ asset('storage/'.$item['product']->foto_produk) }}" alt="{{ $item['product']->nama_produk }}" class="object-cover object-center w-full h-[300px] group-hover:scale-125 duration-300">
                  <button type="button" class="absolute p-2 bg-white rounded-full shadow-md top-2 right-2 hover:bg-gray-100" onclick="document.getElementById('wishlist-form-remove-{{ $item['wishlist']->id }}').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                      <path d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z"></path>
                    </svg>
                  </button>
                  <form id="wishlist-form-remove-{{ $item['wishlist']->id }}" method="POST" action="{{ route('grosir.produk.wishlist.remove') }}" style="display: none;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id_produk" value="{{ $item['wishlist']->id_produk }}">
                  </form>
                </div>
                <a href="/grosir/produk/detail/{{ Str::slug($item['product']->nama_produk) }}">
                  <h3 class="mt-4 text-sm text-gray-700">{{ ucwords($item['product']->nama_produk) }}</h3>
                  <p class="mt-1 text-lg font-medium text-gray-900">Rp{{ number_format($item['product']->harga_produk, 0, ',', '.') }}
                    <span class="select-none text-sm text-gray-400">/ Butir</span>
                  </p>
                </a>
              </div>
              @empty
              <p class="text-gray-500">Wishlist Anda kosong.</p>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('components.grosir.footer')
</body>

</html>