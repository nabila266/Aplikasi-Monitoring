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
        <div class="absolute inset-x-0 overflow-hidden -top-40 -z-10 transform-gpu blur-3xl sm:-top-80" aria-hidden="true">
          <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="py-24 sm:py-32 lg:pb-40">
          <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
              <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Penyedia Telur Berkualitas untuk Grosir Anda</h1>
              <p class="mt-6 text-lg leading-8 text-gray-600">Sebagai agen telur terpercaya, kami menawarkan telur segar dengan harga kompetitif dan layanan pengiriman cepat. Pilih kami untuk memenuhi kebutuhan telur bisnis Anda dengan kualitas terbaik.</p>
              <div class="flex items-center justify-center mt-10 gap-x-6">
                <a href="/grosir/produk/" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Belanja Sekarang</a>
              </div>
            </div>
          </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
          <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white">
    <div class="px-4 py-24 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="px-6 py-16 rounded-2xl bg-gray-50 sm:p-16">
        <div class="max-w-xl mx-auto lg:max-w-none">
          <div class="text-center">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Pelayanan Kami</h2>
          </div>
          <div class="grid max-w-sm grid-cols-1 mx-auto mt-12 gap-x-8 gap-y-10 sm:max-w-none lg:grid-cols-3">
            <div class="text-center sm:flex sm:text-left lg:block lg:text-center">
              <div class="sm:flex-shrink-0">
                <div class="flow-root">
                  <img class="w-16 h-16 mx-auto" src="https://tailwindui.com/img/ecommerce/icons/icon-shipping-simple.svg" alt="">
                </div>
              </div>
              <div class="mt-3 sm:ml-6 sm:mt-0 lg:ml-0 lg:mt-6">
                <h3 class="text-sm font-medium text-gray-900">Pengiriman Gratis</h3>
                <p class="mt-2 text-sm text-gray-500">Pengiriman kami sudah termasuk dalam harga produk. Tidak ada biaya tambahan untuk pengiriman.</p>
              </div>
            </div>
            <div class="text-center sm:flex sm:text-left lg:block lg:text-center">
              <div class="sm:flex-shrink-0">
                <div class="flow-root">
                  <img class="w-16 h-16 mx-auto" src="https://tailwindui.com/img/ecommerce/icons/icon-warranty-simple.svg" alt="">
                </div>
              </div>
              <div class="mt-3 sm:ml-6 sm:mt-0 lg:ml-0 lg:mt-6">
                <h3 class="text-sm font-medium text-gray-900">Garansi 10 Tahun</h3>
                <p class="mt-2 text-sm text-gray-500">Jika produk rusak dalam 10 tahun pertama, kami akan menggantinya. Setelah itu, garansi tidak berlaku.</p>
              </div>
            </div>
            <div class="text-center sm:flex sm:text-left lg:block lg:text-center">
              <div class="sm:flex-shrink-0">
                <div class="flow-root">
                  <img class="w-16 h-16 mx-auto" src="https://tailwindui.com/img/ecommerce/icons/icon-exchange-simple.svg" alt="">
                </div>
              </div>
              <div class="mt-3 sm:ml-6 sm:mt-0 lg:ml-0 lg:mt-6">
                <h3 class="text-sm font-medium text-gray-900">Pertukaran Produk</h3>
                <p class="mt-2 text-sm text-gray-500">Jika Anda tidak puas dengan produk, Anda dapat menukarnya dengan produk lain. Namun, produk tidak dapat dikembalikan ke kami.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('components.grosir.product_features')

  @include('components.grosir.footer')
</body>

</html>