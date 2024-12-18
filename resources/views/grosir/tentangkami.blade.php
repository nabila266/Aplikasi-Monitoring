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

      <div class="relative pt-20 isolate">
        <div class="relative py-24 overflow-hidden bg-gray-900 isolate sm:py-32">
          <img src="https://images.unsplash.com/photo-1522243415254-248420bef151?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Grosir Telur Ayam" class="absolute inset-0 object-cover object-right w-full h-full -z-10 md:object-center brightness-50">
          <div class="hidden sm:absolute sm:-top-10 sm:right-1/2 sm:-z-10 sm:mr-10 sm:block sm:transform-gpu sm:blur-3xl">
            <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
          </div>
          <div class="absolute -top-52 left-1/2 -z-10 -translate-x-1/2 transform-gpu blur-3xl sm:top-[-28rem] sm:ml-16 sm:translate-x-0 sm:transform-gpu">
            <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
          </div>
          <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-2xl mx-auto lg:mx-0">
              <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl lg:leading-tight">Penyedia Telur Berkualitas<br>untuk Grosir Anda</h2>
              <p class="mt-6 text-base leading-7 text-gray-300">Selamat datang di Agen Telur Ayam! Kami adalah penyedia utama telur ayam berkualitas tinggi untuk berbagai kebutuhan. Komitmen kami adalah menyediakan produk telur terbaik dengan harga yang kompetitif.</p>
            </div>

            <div class="grid max-w-2xl grid-cols-1 gap-6 mx-auto mt-16 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-8">
              <div class="flex p-6 gap-x-4 rounded-xl bg-white/5 ring-1 ring-inset ring-white/10">
                <svg class="flex-none w-5 text-indigo-400 h-7" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M15 5V2H5v3H2v13h16V5h-3zm1 11H4v-8h12v8zm-2-4v2h-8v-2h8z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-base leading-7">
                  <h3 class="font-semibold text-white">Misi Kami</h3>
                  <p class="mt-2 text-gray-300">Menyediakan telur ayam segar berkualitas tinggi untuk pelanggan kami dengan pelayanan terbaik dan harga yang kompetitif.</p>
                </div>
              </div>
              <div class="flex p-6 gap-x-4 rounded-xl bg-white/5 ring-1 ring-inset ring-white/10">
                <svg class="flex-none w-5 text-indigo-400 h-7" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.171 4.146l1.947 2.466a3.514 3.514 0 011.764 0l1.947-2.466a6.52 6.52 0 00-5.658 0zm8.683 3.025l-2.466 1.947c.15.578.15 1.186 0 1.764l2.466 1.947a6.52 6.52 0 000-5.658zm-3.025 8.683l-1.947-2.466c-.578.15-1.186.15-1.764 0l-1.947 2.466a6.52 6.52 0 005.658 0zM4.146 12.83l2.466-1.947a3.514 3.514 0 010-1.764L4.146 7.171a6.52 6.52 0 000 5.658zM5.63 3.297a8.01 8.01 0 018.738 0 8.031 8.031 0 012.334 2.334 8.01 8.01 0 010 8.738 8.033 8.033 0 01-2.334 2.334 8.01 8.01 0 01-8.738 0 8.032 8.032 0 01-2.334-2.334 8.01 8.01 0 010-8.738A8.03 8.03 0 015.63 3.297zm5.198 4.882a2.008 2.008 0 00-2.243.407 1.994 1.994 0 00-.407 2.243 1.993 1.993 0 00.992.992 2.008 2.008 0 002.243-.407c.176-.175.31-.374.407-.585a2.008 2.008 0 00-.407-2.243 1.993 1.993 0 00-.585-.407z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-base leading-7">
                  <h3 class="font-semibold text-white">Visi Kami</h3>
                  <p class="mt-2 text-gray-300">Menjadi penyedia utama telur ayam berkualitas di Indonesia dengan komitmen pada kepuasan pelanggan dan keberlanjutan.</p>
                </div>
              </div>
              <div class="flex p-6 gap-x-4 rounded-xl bg-white/5 ring-1 ring-inset ring-white/10">
                <svg class="flex-none w-5 text-indigo-400 h-7" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-base leading-7">
                  <h3 class="font-semibold text-white">Kontak Kami</h3>
                  <p class="mt-2 text-gray-300">Hubungi kami di 0812-3456-7890 atau email ke agentelur@gmail.com untuk informasi lebih lanjut dan pemesanan.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      @include('components.grosir.footer')
</body>

</html>