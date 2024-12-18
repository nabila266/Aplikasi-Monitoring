<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Grosir</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full">
    <div id="app">
        @include('components.agen.sidebar')
        <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 shadow-sm sm:px-6 lg:hidden">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" id="open-sidebar-btn">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                </svg>
            </button>
            <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">Dashboard</div>
        </div>
        <main class="py-10 lg:pl-72">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="relative h-full overflow-hidden rounded-xl shadow-sm">
                    <div class="bg-white py-10">
                        <div class="mx-auto max-w-7xl">
                            <div class="px-4 sm:px-6 lg:px-8">
                                <div class="sm:flex sm:items-center">
                                    <div class="sm:flex-auto">
                                        <h1 class="text-base font-semibold leading-6 text-gray-900">Distribusi</h1>
                                        <p class="mt-2 text-sm text-gray-700">Detail dari proses distribusi termasuk no
                                            resi, tanggal pengiriman, dan status.</p>
                                    </div>
                                </div>
                                <div class="sm:flex sm:items-center">
                                    <div class="sm:flex-auto">
                                        <form action="{{ route('distribusi.exportPDF') }}" method="GET"
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
                                <table class="min-w-full divide-y divide-gray-300 mt-8">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                                No Faktur</th>
                                            <th scope="col"
                                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                                No Resi</th>
                                            <th scope="col"
                                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                                                Tanggal Pengiriman</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Keterangan</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
                                                Pengiriman</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @forelse($distribusis as $distribusi)
                                            <tr>
                                                <td
                                                    class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-0">
                                                    {{ $distribusi->no_faktur }}
                                                </td>
                                                <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">
                                                    {{ $distribusi->no_resi != null ? $distribusi->no_resi : '-' }}
                                                </td>
                                                <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                    {{ $distribusi->tanggal_pengiriman != null ? $distribusi->tanggal_pengiriman : '-' }}
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-500">
                                                    {{ $distribusi->keterangan_pengiriman != null ? $distribusi->keterangan_pengiriman : '-' }}
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-500">
                                                    @if ($distribusi->status_pengiriman == 'diproses')
                                                        <button
                                                            class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 send-button"
                                                            data-id="{{ $distribusi->id }}"
                                                            data-no-faktur="{{ $distribusi->no_faktur }}">
                                                            Kirim
                                                        </button>
                                                    @elseif($distribusi->status_pengiriman == 'dalam perjalanan')
                                                        <span
                                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Dalam
                                                            Perjalanan</span>
                                                    @elseif($distribusi->status_pengiriman == 'diterima')
                                                        <span
                                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Diterima</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-sm text-gray-500">Tidak ada
                                                    data distribusi.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Modal Box -->
        <div id="modal" class="fixed inset-0 z-40 overflow-y-auto hidden">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal content -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form id="modal-form" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="no_faktur" id="no_faktur" value="{{ $distribusi->no_faktur }}">

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 w-full sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Update Informasi Pengiriman
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Silakan masukkan nomor resi dan keterangan pengiriman produk.
                                        </p>
                                    </div>
                                    <div class="mt-4 grid grid-cols-1 w-full gap-4">
                                        <div>
                                            <label for="no_resi"
                                                class="block text-sm font-medium leading-6 text-gray-900">Nomor
                                                Resi</label>
                                            <div class="mt-2">
                                                <input id="no_resi" name="no_resi" type="text"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4"
                                                    placeholder="Masukkan nomor resi">
                                                @error('no_resi')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div>
                                            <label for="keterangan_pengiriman"
                                                class="block text-sm font-medium leading-6 text-gray-900">Keterangan
                                                Pengiriman</label>
                                            <div class="mt-2">
                                                <textarea id="keterangan_pengiriman" name="keterangan_pengiriman" rows="3"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4"
                                                    placeholder="Tambahkan keterangan pengiriman (opsional)"></textarea>
                                                @error('keterangan_pengiriman')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Simpan
                            </button>
                            <button type="button" id="cancel-modal-btn"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openSidebarBtn = document.getElementById('open-sidebar-btn');
            const modal = document.getElementById('modal');
            const cancelModalBtn = document.getElementById('cancel-modal-btn');
            const sendButtons = document.querySelectorAll('.send-button');
            const modalForm = document.getElementById('modal-form');

            // Function to toggle sidebar visibility (if applicable)
            openSidebarBtn.addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('hidden');
            });

            // Function to open modal and set the action URL
            sendButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const distribusiId = this.getAttribute('data-id');
                    const noFaktur = this.getAttribute(
                    'data-no-faktur'); // tambahkan atribut data-no-faktur pada button
                    modalForm.setAttribute('action', `/agen/transaksi/distribusi/kirim`);
                    document.getElementById('no_faktur').value =
                    noFaktur; // set nilai input hidden no_faktur
                    modal.classList.remove('hidden');
                });
            });

            // Function to close modal
            cancelModalBtn.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Close modal on Escape key press
            window.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
