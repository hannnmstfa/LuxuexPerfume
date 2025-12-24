<div>
        <a href="{{ route('keranjang') }}"
        class="flex items-center justify-center text-black bg-yellow-300 hover:bg-yellow-500 rounded-full w-14 h-14 relative">
        <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
        </svg>
        <span class="sr-only">Keranjang</span>
        <span class="absolute top-0 right-0 border border-gray-300 bg-red-500 text-white text-xs font-semibold px-1 rounded-full">
            {{ $jumlah_keranjang }}
        </span>
    </a>
</div>