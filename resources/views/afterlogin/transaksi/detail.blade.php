<x-guest-layout title="Detail {{ $trx->kodeTrx }}">
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
                    d="m19 9-7 7-7-7" />
            </svg>
        </div>
        <h2 class="font-inter text-2xl md:text-3xl font-semibold">DETAIL TRANSAKSI</h2>
    </div>
    <div class="max-w-screen-xl mx-auto p-2">
        <h3 class="font-bold text-2xl">Informasi Pemesanan</h3>
        <hr class="mb-3">
        <div class="grid grid-cols-2 gap-2 spaxe-y-2 md:space-y-0 mb-3">
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm text-gray-500 italic">Kode Transaksi</p>
                <h4 class="font-inter text-xl font-semibold">{{ $trx->kodeTrx }}</h4>
            </div>
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm text-gray-500 italic">Status</p>
                <h4 class="font-inter text-xl font-semibold">
                    @if ($trx->status_bayar !== 'berhasil')
                        <span
                            class="font-semibold {{ $trx->status_bayar == 'menunggu pembayaran' ? 'text-yellow-400' : '' }}">{{ ucwords($trx->status_bayar) }}</span>
                    @endif
                </h4>
            </div>
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm text-gray-500 italic">Waktu Pemesanan</p>
                <h4 class="font-inter text-lg font-semibold">
                    {{ $trx->created_at->isoFormat('dddd, DD MMMM YYYY - H:m') . ' WIB' }}</h4>
            </div>
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm text-gray-500 italic">Waktu Pembayaran</p>
                <h4 class="font-inter text-lg font-semibold">
                    {{ $trx->pay_at ? $trx->pay_at->isoFormat('dddd, DD MMMM YYYY - H:m') . ' WIB' : '--' }}</h4>
            </div>
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm text-gray-500 italic">Metode Pembayaran</p>
                <h4 class="font-inter text-lg font-semibold">{{ $trx->metode_bayar }}</h4>
            </div>
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm text-gray-500 italic">Total Bayar</p>
                <div class="flex justify-start items-center gap-2 relative">
                    <h4 class="font-inter text-xl font-semibold">
                        Rp{{ number_format($trx->total_harga + $trx->fee_payment) }}</h4>
                    <button data-tooltip-target="rincian" type="button">
                        <svg class="w-4 h-4 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="rincian" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded shadow-xs opacity-0 tooltip">
                        Rincian Harga:
                        <ul class="list-disc pl-5">
                            <li>Subtotal: Rp{{ number_format($trx->subtotal) }}</li>
                            <li>Ongkir: Rp{{ number_format($trx->ongkir) }}</li>
                            <li>Fee payment: Rp{{ number_format($trx->fee_payment) }}</li>
                        </ul>
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    <a href="{{ route('trx.pay', $trx->kodeTrx) }}"
                        class="px-3 py-1 {{ $trx->pay_at !== null ? 'hidden' : '' }} rounded bg-yellow-500 hover:bg-yellow-600 font-bold text-white ">Bayar</a>
                </div>
            </div>
        </div>
        <h3 class="font-bold text-2xl pt-3">Informasi Penerima</h3>
        <hr class="mb-3">
        <div class="grid grid-cols-2 gap-2 spaxe-y-2 md:space-y-0 mb-5">
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm text-gray-500 italic">Nama Penerima</p>
                <h4 class="font-inter text-lg font-semibold">{{ $trx->transaksi_details->nama_penerima }}</h4>
            </div>
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm text-gray-500 italic">No Penerima</p>
                <h4 class="font-inter text-lg font-semibold">{{ $trx->transaksi_details->no_penerima }}</h4>
            </div>
            <div class="col-span-2">
                <p class="text-sm text-gray-500 italic">Alamat Lengkap Penerima</p>
                <h4 class="font-inter text-lg font-semibold">{{ $trx->transaksi_details->alamat_penerima }}</h4>
            </div>
        </div>
        <div class="overflow-auto rounded shadow">
            <table class="w-full">
                <thead>
                    <tr class="font-inter text-lg border-b  bg-orange-200">
                        <th colspan="4" class="py-1">Rincian Pesanan</th>
                    </tr>
                    <tr class="font-inter border-b bg-gray-100">
                        <th class="text-left py-2 px-4">Produk</th>
                        <th class="text-left py-2 px-4">Harga Satuan</th>
                        <th class="text-center py-2 px-4">Jumlah</th>
                        <th class="text-right py-2 px-4">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trx->transaksi_items as $item)
                        <tr class="border-b">
                            <td class="py-2 px-4">
                                <div class="flex flex-col md:flex-row justify-start items-center gap-3">
                                    <img src="{{ asset($item->produks->path_foto) }}" alt="{{ $item->produks->nama }}"
                                        class="w-14 h-14 object-cover rounded" />
                                    <div class="text-center lg:text-left">
                                        <p class="font-semibold">{{ $item->produks->nama }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-left py-2 px-4">Rp{{ number_format($item->harga) }}</td>
                            <td class="text-center py-2 px-4">{{ $item->jumlah }}</td>
                            <td class="text-right py-2 px-4 font-semibold">Rp{{ number_format($item->subtotal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-guest-layout>