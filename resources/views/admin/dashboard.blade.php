<x-app-layout title="Dashboard Admin">
    <div class="grid lg:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg shadow p-4 relative">
            <h2 class="text-xl font-semibold mb-2">Total Penjualan</h2>
            <div class="flex justify-start items-center gap-2">
                <p class="text-3xl font-bold text-yellow-600">Rp{{ number_format($trx->sum('total_harga')) }}</p>
                <button data-tooltip-target="penjualan" type="button" data-tooltip-placement="right">
                    <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div id="penjualan" role="tooltip"
                class="absolute z-40 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded shadow-xs opacity-0 tooltip">
                Kode Area
                <p class="text-sm">*Didapatkan saat pengguna memilih wilayah saat checkout. Kode area ini resmi
                    dan
                    sesuai dengan Kepmendagri No 300.2.2-2138 Tahun 2025</p>
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-2">Menunggu Diproses</h2>
            <p class="text-3xl font-bold text-yellow-600">{{ number_format($menungguProses->count()) }} Transaksi</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-2">Stok Habis</h2>
            <p class="text-3xl font-bold text-yellow-600">{{ number_format($stokHabis->count()) }} Produk</p>
        </div>
    </div>
</x-app-layout>