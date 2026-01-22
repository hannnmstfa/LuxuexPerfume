<x-guest-layout title="Pembayaran {{ $trx->kodeTrx }}">
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
            <a href="{{ route('trx.index') }}" class="text-xs hover:text-yellow-600 hover:underline">
                Transaksi
            </a>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg>
            <a href="{{ route('trx.show', $trx->kodeTrx) }}" class="text-xs hover:text-yellow-600 hover:underline">
                Detail
            </a>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 9-7 7-7-7" />
            </svg>
        </div>
        <h2 class="font-inter text-2xl md:text-3xl font-semibold">PEMBAYARAN</h2>
    </div>
    <div class="max-w-screen-xl mx-auto p-4">
        <iframe class="w-full h-[600px] border-0" src="{{ $detail_tripay['data']['checkout_url'] }}" frameborder="0"></iframe>
</x-guest-layout>