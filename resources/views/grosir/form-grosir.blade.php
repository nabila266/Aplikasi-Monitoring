<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aplikasi Grosir</title>

  @vite('resources/css/app.css')

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full" style="background-image: url('img/form/daftar-grosir.png'); background-size: cover;">
  <main class="py-10">
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="relative flex justify-center overflow-hidden rounded-xl">
        <form class="w-screen max-w-screen-md bg-white shadow-sm p-8 rounded-xl" action="/form-grosir" method="POST">
          @csrf

          <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

          <div class="space-y-12">
            <div class="pb-12 border-b border-gray-900/10">
              <h2 class="text-xl font-semibold leading-7 text-gray-900">Data Grosir</h2>
              <p class="mt-1 text-sm leading-6 text-gray-600"></p>

              <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-full">
                  <label for="nama_grosir" class="block text-sm font-medium leading-6 text-gray-900">Nama Grosir</label>
                  <div class="mt-2">
                    <input id="nama_grosir" name="nama_grosir" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                  </div>
                </div>

                <div class="sm:col-span-full">
                  <label for="nomor_telefon_grosir" class="block text-sm font-medium leading-6 text-gray-900">Nomor Handphone Grosir</label>
                  <div class="mt-2">
                    <input id="nomor_telefon_grosir" name="nomor_telefon_grosir" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                  </div>
                </div>

                <div class="col-span-full">
                  <label for="alamat_grosir" class="block text-sm font-medium leading-6 text-gray-900">Alamat</label>
                  <div class="mt-2">
                    <textarea id="alamat_grosir" name="alamat_grosir" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4"></textarea>
                  </div>
                </div>

                <div class="col-span-full">
                  <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Photo Grosir <span class="text-gray-400 select-none">(Optional)</span></label>
                  <div class="flex justify-center px-6 py-10 mt-2 border border-dashed rounded-lg border-gray-900/25">
                    <div class="text-center">
                      <svg class="w-12 h-12 mx-auto text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                      </svg>
                      <div class="flex mt-4 text-sm leading-6 text-gray-600">
                        <label for="foto_grosir" class="relative font-semibold text-indigo-600 bg-white rounded-md cursor-pointer focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                          <span>Upload a file</span>
                          <input id="foto_grosir" name="foto_grosir" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                      </div>
                      <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="flex items-center justify-end mt-6 gap-x-6">
              <button type="submit" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>

</html>