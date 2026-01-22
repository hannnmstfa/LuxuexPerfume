<x-guest-layout title="Checkout">
    <div class="flex flex-col justify-center items-center py-9 bg-gray-300 shadow-inner">
        <div class="inline-flex justify-center items-center gap-1">
            <a href="{{ route('/') }}" class="text-xs hover:text-yellow-600 hover:underline">
                Home
            </a>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg>
            <a href="{{ route('keranjang') }}" class="text-xs hover:text-yellow-600 hover:underline">
                Keranjang
            </a>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
            </svg>
        </div>
        <h2 class="font-inter text-2xl md:text-3xl font-semibold">CHECKOUT</h2>
        <h4 class="font-inter text-xs text-gray-500">Lengkapi Data Pengiriman dan Pilih Metode Pembayaran</h4>
    </div>
    <livewire:checkout/>
</x-guest-layout>