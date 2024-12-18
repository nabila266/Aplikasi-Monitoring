<!-- Static sidebar for desktop -->
<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
  <!-- Sidebar component, swap this element with another sidebar if you like -->
  <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
    <div class="flex h-16 shrink-0 items-center">
      <img class="h-8 w-auto" src="{{ asset('img/logo/logo.png') }}" alt="Agen">
    </div>
    <nav class="flex flex-1 flex-col">
      <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
          <ul role="list" class="-mx-2 space-y-1">
            <li>
              <a href="/agen/"
                class="{{ request()->path() == 'agen' ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 {{ request()->path() == 'agen' ? 'fill-indigo-600' : 'fill-gray-400 group-hover:fill-indigo-600' }}" viewBox="0 0 24 24">
                  <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"></path>
                </svg>
                Dashboard
              </a>
            </li>
            <li>
              <a href="/agen/grosir" class="{{ request()->path() == 'agen/grosir' ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 {{ request()->path() == 'agen/grosir' ? 'fill-indigo-600' : 'fill-gray-400 group-hover:fill-indigo-600' }}" viewBox="0 0 24 24">
                  <path d="M19.148 2.971A2.008 2.008 0 0 0 17.434 2H6.566c-.698 0-1.355.372-1.714.971L2.143 7.485A.995.995 0 0 0 2 8a3.97 3.97 0 0 0 1 2.618V19c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-8.382A3.97 3.97 0 0 0 22 8a.995.995 0 0 0-.143-.515l-2.709-4.514zm.836 5.28A2.003 2.003 0 0 1 18 10c-1.103 0-2-.897-2-2 0-.068-.025-.128-.039-.192l.02-.004L15.22 4h2.214l2.55 4.251zM10.819 4h2.361l.813 4.065C13.958 9.137 13.08 10 12 10s-1.958-.863-1.993-1.935L10.819 4zM6.566 4H8.78l-.76 3.804.02.004C8.025 7.872 8 7.932 8 8c0 1.103-.897 2-2 2a2.003 2.003 0 0 1-1.984-1.749L6.566 4zM10 19v-3h4v3h-4zm6 0v-3c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v3H5v-7.142c.321.083.652.142 1 .142a3.99 3.99 0 0 0 3-1.357c.733.832 1.807 1.357 3 1.357s2.267-.525 3-1.357A3.99 3.99 0 0 0 18 12c.348 0 .679-.059 1-.142V19h-3z"></path>
                </svg>
                Reseller/Grosir
              </a>
            </li>
          </ul>
        </li>
        <li>
          <div class="text-xs font-semibold leading-6 text-gray-400">Produk</div>
          <ul role="list" class="-mx-2 mt-2 space-y-1">
            <li>
              <a href="/agen/penyimpanan/" class="{{ request()->path() == 'agen/penyimpanan' ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex items-center gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.269424 5.63841C0.175765 6.0419 0.426928 6.44492 0.830414 6.53858C1.2339 6.63224 1.63692 6.38107 1.73058 5.97759L0.269424 5.63841ZM2 1.5V0.75C1.65112 0.75 1.34831 0.990569 1.26942 1.33041L2 1.5ZM6 2.25C6.41421 2.25 6.75 1.91421 6.75 1.5C6.75 1.08579 6.41421 0.75 6 0.75V2.25ZM1.75 5.808C1.75 5.39379 1.41421 5.058 1 5.058C0.585786 5.058 0.25 5.39379 0.25 5.808H1.75ZM1 15.5H0.25C0.25 15.9142 0.585786 16.25 1 16.25L1 15.5ZM15 15.5V16.25C15.4142 16.25 15.75 15.9142 15.75 15.5H15ZM15.75 5.808C15.75 5.39379 15.4142 5.058 15 5.058C14.5858 5.058 14.25 5.39379 14.25 5.808H15.75ZM1 5.058C0.585786 5.058 0.25 5.39379 0.25 5.808C0.25 6.22221 0.585786 6.558 1 6.558V5.058ZM6 6.558C6.41421 6.558 6.75 6.22221 6.75 5.808C6.75 5.39379 6.41421 5.058 6 5.058V6.558ZM6 5.058C5.58579 5.058 5.25 5.39379 5.25 5.808C5.25 6.22221 5.58579 6.558 6 6.558V5.058ZM10 6.558C10.4142 6.558 10.75 6.22221 10.75 5.808C10.75 5.39379 10.4142 5.058 10 5.058V6.558ZM5.25 5.808C5.25 6.22221 5.58579 6.558 6 6.558C6.41421 6.558 6.75 6.22221 6.75 5.808H5.25ZM6.75 1.5C6.75 1.08579 6.41421 0.75 6 0.75C5.58579 0.75 5.25 1.08579 5.25 1.5H6.75ZM6.75 5.808C6.75 5.39379 6.41421 5.058 6 5.058C5.58579 5.058 5.25 5.39379 5.25 5.808H6.75ZM6 9.5H5.25C5.25 9.75993 5.38459 10.0013 5.6057 10.138C5.82681 10.2746 6.10292 10.2871 6.33541 10.1708L6 9.5ZM8 8.5L8.33541 7.82918C8.12426 7.72361 7.87574 7.72361 7.66459 7.82918L8 8.5ZM10 9.5L9.66459 10.1708C9.89708 10.2871 10.1732 10.2746 10.3943 10.138C10.6154 10.0013 10.75 9.75993 10.75 9.5H10ZM10.75 5.808C10.75 5.39379 10.4142 5.058 10 5.058C9.58579 5.058 9.25 5.39379 9.25 5.808H10.75ZM6 0.75C5.58579 0.75 5.25 1.08579 5.25 1.5C5.25 1.91421 5.58579 2.25 6 2.25V0.75ZM10 2.25C10.4142 2.25 10.75 1.91421 10.75 1.5C10.75 1.08579 10.4142 0.75 10 0.75V2.25ZM14.2694 5.97759C14.3631 6.38107 14.7661 6.63224 15.1696 6.53858C15.5731 6.44492 15.8242 6.0419 15.7306 5.63841L14.2694 5.97759ZM14 1.5L14.7306 1.33041C14.6517 0.990569 14.3489 0.75 14 0.75V1.5ZM10 0.75C9.58579 0.75 9.25 1.08579 9.25 1.5C9.25 1.91421 9.58579 2.25 10 2.25V0.75ZM15 6.558C15.4142 6.558 15.75 6.22221 15.75 5.808C15.75 5.39379 15.4142 5.058 15 5.058V6.558ZM10 5.058C9.58579 5.058 9.25 5.39379 9.25 5.808C9.25 6.22221 9.58579 6.558 10 6.558V5.058ZM9.25 5.808C9.25 6.22221 9.58579 6.558 10 6.558C10.4142 6.558 10.75 6.22221 10.75 5.808H9.25ZM10.75 1.5C10.75 1.08579 10.4142 0.75 10 0.75C9.58579 0.75 9.25 1.08579 9.25 1.5H10.75ZM1.73058 5.97759L2.73058 1.66959L1.26942 1.33041L0.269424 5.63841L1.73058 5.97759ZM2 2.25H6V0.75H2V2.25ZM0.25 5.808V15.5H1.75V5.808H0.25ZM1 16.25H15V14.75H1V16.25ZM15.75 15.5V5.808H14.25V15.5H15.75ZM1 6.558H6V5.058H1V6.558ZM6 6.558H10V5.058H6V6.558ZM6.75 5.808V1.5H5.25V5.808H6.75ZM5.25 5.808V9.5H6.75V5.808H5.25ZM6.33541 10.1708L8.33541 9.17082L7.66459 7.82918L5.66459 8.82918L6.33541 10.1708ZM7.66459 9.17082L9.66459 10.1708L10.3354 8.82918L8.33541 7.82918L7.66459 9.17082ZM10.75 9.5V5.808H9.25V9.5H10.75ZM6 2.25H10V0.75H6V2.25ZM15.7306 5.63841L14.7306 1.33041L13.2694 1.66959L14.2694 5.97759L15.7306 5.63841ZM14 0.75H10V2.25H14V0.75ZM15 5.058H10V6.558H15V5.058ZM10.75 5.808V1.5H9.25V5.808H10.75Z" fill="#4B5563" />
                </svg>
                Penyimpanan
              </a>
            </li>
            <li>
              <a href="/agen/produk/telur-expired" class="{{ request()->path() == 'agen/produk/telur-expired' ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex items-center gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M1 7.99964C1.00013 5.90377 1.93936 3.91824 3.55956 2.58873C5.17975 1.25923 7.31043 0.725644 9.366 1.13464L9.561 1.17664C12.285 1.80025 14.3771 3.98423 14.8831 6.73248C15.3892 9.48074 14.2122 12.2667 11.889 13.8196C11.8223 13.8636 11.7557 13.9066 11.689 13.9486C9.53014 15.2873 6.81546 15.3514 4.59584 14.1161C2.37621 12.8807 1.00002 10.5399 1 7.99964Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M4 6.49951C4.44862 4.88118 5.83209 3.69534 7.5 3.49951" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                Telur Expired
              </a>
            </li>
            <li>
              <a href="/agen/produk/jit" class="{{ request()->path() == 'agen/produk/jit' ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex items-center gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M1.00002 14.211V5.737C0.997245 5.30439 1.34541 4.9513 1.77802 4.948H4.88902C5.32162 4.9513 5.66979 5.30439 5.66702 5.737V1.789C5.66424 1.35678 6.0118 1.00385 6.44402 1H9.55602C9.98862 1.0033 10.3368 1.35639 10.334 1.789V4.158C10.3312 3.72539 10.6794 3.3723 11.112 3.369H14.223C14.6552 3.37285 15.0028 3.72578 15 4.158V14.211C15.0028 14.6436 14.6546 14.9967 14.222 15H1.77802C1.34541 14.9967 0.997245 14.6436 1.00002 14.211V14.211Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M4.91699 15C4.91699 15.4142 5.25278 15.75 5.66699 15.75C6.08121 15.75 6.41699 15.4142 6.41699 15H4.91699ZM6.41699 5.73696C6.41699 5.32275 6.08121 4.98696 5.66699 4.98696C5.25278 4.98696 4.91699 5.32275 4.91699 5.73696H6.41699ZM9.58299 15C9.58299 15.4142 9.91878 15.75 10.333 15.75C10.7472 15.75 11.083 15.4142 11.083 15H9.58299ZM11.083 4.15796C11.083 3.74375 10.7472 3.40796 10.333 3.40796C9.91878 3.40796 9.58299 3.74375 9.58299 4.15796H11.083ZM6.41699 15V5.73696H4.91699V15H6.41699ZM11.083 15V4.15796H9.58299V15H11.083Z" fill="#4B5563" />
                </svg>
                Just In Time
              </a>
            </li>
          </ul>
        </li>
        <li>
          <div class="text-xs font-semibold leading-6 text-gray-400">Transaksi</div>
          <ul role="list" class="-mx-2 mt-2 space-y-1">
            <li>
              <a href="/agen/transaksi/pembelian" class="{{ request()->path() == 'agen/transaksi/pembelian' ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex items-center gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-1">
                  <path d="M3.74542 4.91722C3.6997 4.50553 3.3289 4.20886 2.91722 4.25458C2.50553 4.3003 2.20886 4.6711 2.25458 5.08278L3.74542 4.91722ZM3.913 13.221L3.16758 13.3038L3.16759 13.3039L3.913 13.221ZM5.9 15L5.89972 15.75H5.9V15ZM16.1 15L16.1001 14.25H16.1V15ZM18.088 13.221L18.8334 13.3039L18.8334 13.3037L18.088 13.221ZM19.7454 5.08269C19.7911 4.67101 19.4944 4.30024 19.0827 4.25457C18.671 4.2089 18.3002 4.50562 18.2546 4.91731L19.7454 5.08269ZM1 4.25C0.585786 4.25 0.25 4.58579 0.25 5C0.25 5.41421 0.585786 5.75 1 5.75V4.25ZM21 5.75C21.4142 5.75 21.75 5.41421 21.75 5C21.75 4.58579 21.4142 4.25 21 4.25V5.75ZM3.32918 4.66459C3.14394 5.03507 3.29411 5.48558 3.66459 5.67082C4.03507 5.85606 4.48558 5.70589 4.67082 5.33541L3.32918 4.66459ZM6.67082 1.33541C6.85606 0.964926 6.70589 0.514422 6.33541 0.32918C5.96493 0.143938 5.51442 0.294106 5.32918 0.66459L6.67082 1.33541ZM17.3292 5.33541C17.5144 5.70589 17.9649 5.85606 18.3354 5.67082C18.7059 5.48558 18.8561 5.03507 18.6708 4.66459L17.3292 5.33541ZM16.6708 0.66459C16.4856 0.294106 16.0351 0.143938 15.6646 0.32918C15.2941 0.514422 15.1439 0.964926 15.3292 1.33541L16.6708 0.66459ZM7.25 11C7.25 11.4142 7.58579 11.75 8 11.75C8.41421 11.75 8.75 11.4142 8.75 11H7.25ZM8.75 9C8.75 8.58579 8.41421 8.25 8 8.25C7.58579 8.25 7.25 8.58579 7.25 9H8.75ZM10.25 11C10.25 11.4142 10.5858 11.75 11 11.75C11.4142 11.75 11.75 11.4142 11.75 11H10.25ZM11.75 9C11.75 8.58579 11.4142 8.25 11 8.25C10.5858 8.25 10.25 8.58579 10.25 9H11.75ZM13.25 11C13.25 11.4142 13.5858 11.75 14 11.75C14.4142 11.75 14.75 11.4142 14.75 11H13.25ZM14.75 9C14.75 8.58579 14.4142 8.25 14 8.25C13.5858 8.25 13.25 8.58579 13.25 9H14.75ZM2.25458 5.08278L3.16758 13.3038L4.65842 13.1382L3.74542 4.91722L2.25458 5.08278ZM3.16759 13.3039C3.32238 14.6961 4.49893 15.7495 5.89972 15.75L5.90028 14.25C5.26356 14.2498 4.72877 13.771 4.65841 13.1381L3.16759 13.3039ZM5.9 15.75H16.1V14.25H5.9V15.75ZM16.0999 15.75C17.5012 15.7502 18.6786 14.6966 18.8334 13.3039L17.3426 13.1381C17.2722 13.7712 16.7371 14.2501 16.1001 14.25L16.0999 15.75ZM18.8334 13.3037L19.7454 5.08269L18.2546 4.91731L17.3426 13.1383L18.8334 13.3037ZM1 5.75H21V4.25H1V5.75ZM4.67082 5.33541L6.67082 1.33541L5.32918 0.66459L3.32918 4.66459L4.67082 5.33541ZM18.6708 4.66459L16.6708 0.66459L15.3292 1.33541L17.3292 5.33541L18.6708 4.66459ZM8.75 11V9H7.25V11H8.75ZM11.75 11V9H10.25V11H11.75ZM14.75 11V9H13.25V11H14.75Z" fill="#4B5563" />
                </svg>
                Pembelian
              </a>
            </li>
            <li>
              <a href="/agen/transaksi/penjualan" class="{{ request()->path() == 'agen/transaksi/penjualan' ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex items-center gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-1 mr-2">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M3.0852 13.982L1.3182 14.882C1.24952 14.9162 1.16799 14.9121 1.10305 14.8713C1.03811 14.8304 0.99914 14.7587 1.0002 14.682V1.955C0.989597 1.4384 1.39961 1.01093 1.9162 1H11.0832C11.5998 1.01093 12.0098 1.4384 11.9992 1.955V14.682C12.0003 14.7587 11.9613 14.8304 11.8963 14.8713C11.8314 14.9121 11.7499 14.9162 11.6812 14.882L9.9142 13.982C9.84383 13.9461 9.75945 13.9514 9.6942 13.996L8.2722 14.962C8.19857 15.0121 8.10183 15.0121 8.0282 14.962L6.6222 14.007C6.54857 13.9569 6.45183 13.9569 6.3782 14.007L4.9722 14.962C4.89857 15.0121 4.80183 15.0121 4.7282 14.962L3.3052 14C3.2407 13.9542 3.1563 13.9472 3.0852 13.982Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M3.49927 7.25C3.08505 7.25 2.74927 7.58579 2.74927 8C2.74927 8.41421 3.08505 8.75 3.49927 8.75V7.25ZM9.49927 8.75C9.91348 8.75 10.2493 8.41421 10.2493 8C10.2493 7.58579 9.91348 7.25 9.49927 7.25V8.75ZM4.49927 9.25C4.08505 9.25 3.74927 9.58579 3.74927 10C3.74927 10.4142 4.08505 10.75 4.49927 10.75V9.25ZM8.49927 10.75C8.91348 10.75 9.24927 10.4142 9.24927 10C9.24927 9.58579 8.91348 9.25 8.49927 9.25V10.75ZM4.49927 5.25C4.08505 5.25 3.74927 5.58579 3.74927 6C3.74927 6.41421 4.08505 6.75 4.49927 6.75V5.25ZM8.49927 6.75C8.91348 6.75 9.24927 6.41421 9.24927 6C9.24927 5.58579 8.91348 5.25 8.49927 5.25V6.75ZM3.49927 8.75H9.49927V7.25H3.49927V8.75ZM4.49927 10.75H8.49927V9.25H4.49927V10.75ZM4.49927 6.75H8.49927V5.25H4.49927V6.75Z" fill="#4B5563" />
                </svg>

                @php
                  $transaksiPending = \App\Models\Transaksi::where('status', 'pending')->distinct('no_faktur')->count('no_faktur');
                  $transaksiSuccess = \App\Models\Transaksi::where('status', 'berhasil')->count();
                @endphp
                Penjualan
                @if($transaksiPending)
                  <span class="inline-flex items-center gap-x-1.5 py-1.5 p-3 rounded-full text-xs font-medium bg-yellow-500/75 text-white">{{ $transaksiPending }}</span>
                @endif
              </a>
            </li>
            <li>
              <a href="/agen/transaksi/distribusi" class="{{ request()->path() == 'agen/transaksi/distribusi' ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex items-center gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                <svg width="26" height="16" viewBox="0 0 26 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5999 12.8259C12.5757 13.9962 11.6116 14.9277 10.4411 14.9117C9.27068 14.8956 8.33249 13.938 8.34038 12.7675C8.34828 11.5969 9.2993 10.6521 10.4699 10.6519C11.0406 10.6577 11.5857 10.89 11.9852 11.2977C12.3846 11.7054 12.6057 12.2551 12.5999 12.8259V12.8259Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M22.7449 12.8259C22.7207 13.9962 21.7566 14.9277 20.5862 14.9117C19.4157 14.8956 18.4775 13.938 18.4854 12.7675C18.4933 11.5969 19.4443 10.6521 20.6149 10.6519C21.1857 10.6577 21.7307 10.89 22.1302 11.2977C22.5296 11.7054 22.7508 12.2551 22.7449 12.8259V12.8259Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M18.234 13.576C18.6482 13.576 18.984 13.2402 18.984 12.826C18.984 12.4118 18.6482 12.076 18.234 12.076V13.576ZM12.6 12.076C12.1858 12.076 11.85 12.4118 11.85 12.826C11.85 13.2402 12.1858 13.576 12.6 13.576V12.076ZM17.488 12.826C17.488 13.2402 17.8238 13.576 18.238 13.576C18.6522 13.576 18.988 13.2402 18.988 12.826H17.488ZM18.988 7.559C18.988 7.14479 18.6522 6.809 18.238 6.809C17.8238 6.809 17.488 7.14479 17.488 7.559H18.988ZM18.238 12.076C17.8238 12.076 17.488 12.4118 17.488 12.826C17.488 13.2402 17.8238 13.576 18.238 13.576V12.076ZM18.489 13.576C18.9032 13.576 19.239 13.2402 19.239 12.826C19.239 12.4118 18.9032 12.076 18.489 12.076V13.576ZM22.7331 12.0762C22.319 12.0849 21.9904 12.4277 21.9992 12.8419C22.0079 13.256 22.3507 13.5846 22.7649 13.5758L22.7331 12.0762ZM25 10.485L25.7499 10.4715C25.7492 10.4318 25.7453 10.3923 25.7383 10.3533L25 10.485ZM25.2163 7.42728C25.1436 7.0195 24.7541 6.74791 24.3463 6.82066C23.9385 6.8934 23.6669 7.28295 23.7397 7.69072L25.2163 7.42728ZM18.234 2.127C17.8198 2.127 17.484 2.46279 17.484 2.877C17.484 3.29121 17.8198 3.627 18.234 3.627V2.127ZM21.805 2.877L21.805 3.62701L21.8097 3.62699L21.805 2.877ZM23.4346 3.56387L22.8944 4.08418L22.8944 4.08418L23.4346 3.56387ZM24.06 5.218L23.3107 5.18522C23.3083 5.24032 23.312 5.29553 23.3217 5.34983L24.06 5.218ZM23.7397 7.69083C23.8125 8.0986 24.2021 8.37013 24.6098 8.29732C25.0176 8.22451 25.2891 7.83493 25.2163 7.42717L23.7397 7.69083ZM18.984 2.877C18.984 2.46279 18.6482 2.127 18.234 2.127C17.8198 2.127 17.484 2.46279 17.484 2.877H18.984ZM17.484 7.559C17.484 7.97321 17.8198 8.309 18.234 8.309C18.6482 8.309 18.984 7.97321 18.984 7.559H17.484ZM17.484 2.877C17.484 3.29121 17.8198 3.627 18.234 3.627C18.6482 3.627 18.984 3.29121 18.984 2.877H17.484ZM18.234 2.077L17.484 2.07208V2.077H18.234ZM17.17 1L17.1742 0.25H17.17V1ZM7.585 1L7.585 0.249992L7.5815 0.250008L7.585 1ZM6.82986 1.31693L6.29705 0.789082L6.29705 0.789082L6.82986 1.31693ZM6.52 2.075L7.27001 2.075L7.26999 2.07149L6.52 2.075ZM6.52 11.75L7.27 11.7535V11.75H6.52ZM6.82986 12.5081L6.29705 13.0359L6.29705 13.0359L6.82986 12.5081ZM7.585 12.825L7.5815 13.575H7.585V12.825ZM8.336 13.575C8.75021 13.575 9.086 13.2392 9.086 12.825C9.086 12.4108 8.75021 12.075 8.336 12.075V13.575ZM18.236 6.808C17.8218 6.808 17.486 7.14379 17.486 7.558C17.486 7.97221 17.8218 8.308 18.236 8.308V6.808ZM24.48 8.308C24.8942 8.308 25.23 7.97221 25.23 7.558C25.23 7.14379 24.8942 6.808 24.48 6.808V8.308ZM1 2.25C0.585786 2.25 0.25 2.58579 0.25 3C0.25 3.41421 0.585786 3.75 1 3.75V2.25ZM4.13 3.75C4.54421 3.75 4.88 3.41421 4.88 3C4.88 2.58579 4.54421 2.25 4.13 2.25V3.75ZM2 5.25C1.58579 5.25 1.25 5.58579 1.25 6C1.25 6.41421 1.58579 6.75 2 6.75V5.25ZM4 6.75C4.41421 6.75 4.75 6.41421 4.75 6C4.75 5.58579 4.41421 5.25 4 5.25V6.75ZM2.61 8.25C2.19579 8.25 1.86 8.58579 1.86 9C1.86 9.41421 2.19579 9.75 2.61 9.75V8.25ZM4 9.75C4.41421 9.75 4.75 9.41421 4.75 9C4.75 8.58579 4.41421 8.25 4 8.25V9.75ZM18.234 12.076H12.6V13.576H18.234V12.076ZM18.988 12.826V7.559H17.488V12.826H18.988ZM18.238 13.576H18.489V12.076H18.238V13.576ZM22.7649 13.5758C24.4453 13.5403 25.7802 12.152 25.7499 10.4715L24.2501 10.4985C24.2655 11.3526 23.5871 12.0581 22.7331 12.0762L22.7649 13.5758ZM25.7383 10.3533L25.2163 7.42728L23.7397 7.69072L24.2617 10.6167L25.7383 10.3533ZM18.234 3.627H21.805V2.127H18.234V3.627ZM21.8097 3.62699C22.2186 3.62441 22.6107 3.78967 22.8944 4.08418L23.9747 3.04355C23.406 2.45314 22.62 2.12185 21.8003 2.12701L21.8097 3.62699ZM22.8944 4.08418C23.1781 4.37869 23.3286 4.77668 23.3107 5.18522L24.8093 5.25078C24.8451 4.4318 24.5435 3.63396 23.9747 3.04355L22.8944 4.08418ZM23.3217 5.34983L23.7397 7.69083L25.2163 7.42717L24.7983 5.08617L23.3217 5.34983ZM17.484 2.877V7.559H18.984V2.877H17.484ZM18.984 2.877V2.077H17.484V2.877H18.984ZM18.984 2.08192C18.9872 1.59893 18.7982 1.13449 18.4587 0.790887L17.3917 1.84509C17.4514 1.9055 17.4846 1.98716 17.484 2.07208L18.984 2.08192ZM18.4587 0.790887C18.1193 0.447287 17.6572 0.25271 17.1742 0.250012L17.1658 1.74999C17.2507 1.75046 17.332 1.78467 17.3917 1.84509L18.4587 0.790887ZM17.17 0.25H7.585V1.75H17.17V0.25ZM7.5815 0.250008C7.09881 0.252258 6.63678 0.446169 6.29705 0.789082L7.36266 1.84477C7.42239 1.78448 7.50363 1.75039 7.5885 1.74999L7.5815 0.250008ZM6.29705 0.789082C5.95733 1.13199 5.76775 1.59582 5.77001 2.07851L7.26999 2.07149C7.26959 1.98662 7.30293 1.90507 7.36266 1.84477L6.29705 0.789082ZM5.77 2.075V11.75H7.27V2.075H5.77ZM5.77001 11.7465C5.76775 12.2292 5.95733 12.693 6.29705 13.0359L7.36266 11.9802C7.30293 11.9199 7.26959 11.8384 7.26999 11.7535L5.77001 11.7465ZM6.29705 13.0359C6.63678 13.3788 7.09881 13.5727 7.5815 13.575L7.5885 12.075C7.50363 12.0746 7.42239 12.0405 7.36266 11.9802L6.29705 13.0359ZM7.585 13.575H8.336V12.075H7.585V13.575ZM18.236 8.308H24.48V6.808H18.236V8.308ZM1 3.75H4.13V2.25H1V3.75ZM2 6.75H4V5.25H2V6.75ZM2.61 9.75H4V8.25H2.61V9.75Z" fill="#4B5563" />
                </svg>
                Distribusi
              </a>
            </li>
          </ul>
        </li>
        <li class="-mx-6 mt-auto">
          <a href="/agen/profil/" class="flex items-center gap-x-4 px-6 py-3 text-sm font-semibold leading-6 text-gray-900 hover:bg-gray-50">
            @php
            $agen = \App\Models\Agen::where('id_user', Auth::user()->id)->first();
            @endphp
            <img class="h-8 w-8 object-cover rounded-full bg-gray-50"
                 src="{{ isset($agen) && $agen->foto_agen ? asset('storage/'.$agen->foto_agen) : asset('upload/foto_agen/default.png') }}"
                 alt="Agen Avatar">
            <span class="sr-only">Profil Anda</span>
            <span aria-hidden="true">
              {{ ucwords(optional(\App\Models\Agen::where('id_user', Auth::user()->id)->first())->nama_agen) }}
            </span>
          </a>

          <form action="/logout" method="POST" class="flex justify-center items-center">
            @csrf

            <button type="submit" class="w-full rounded-lg text-red-500 gap-x-4 px-6 py-3 text-sm font-semibold leading-6 hover:bg-gray-50">
              <span class="sr-only">Logout</span>
              <span aria-hidden="true">Logout</span>
            </button>

          </form>
        </li>
      </ul>
    </nav>
  </div>
</div>
