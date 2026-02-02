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
                <p class="text-sm text-gray-500 italic">Status Pembayaran</p>
                <div class="font-inter text-sm font-bold flex justify-start items-center">
                    @if ($trx->status_bayar !== 'berhasil')
                        <span
                            class="border  rounded py-1 px-2 {{ $trx->status_bayar == 'menunggu pembayaran' ? 'border-yellow-300 bg-yellow-200 text-yellow-700' : '' }}  {{ $trx->status_bayar == 'kadaluarsa' ? 'border-gray-400 bg-gray-300 text-gray-700' : '' }} {{ $trx->status_bayar == 'gagal' ? 'border-red-400 bg-red-300 text-red-700' : '' }}">{{ $trx->status_bayar !== 'menunggu pembayaran' ? 'Pembayaran' : '' }}
                            {{ ucwords($trx->status_bayar) }}</span>
                    @else
                        <span class="bg-green-200 border-green-300 py-1 px-2 rounded border text-green-600">Pembayaran
                            {{ ucwords($trx->status_bayar) }}</span>
                    @endif
                </div>
            </div>
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm text-gray-500 italic">Waktu Pemesanan</p>
                <h4 class="font-inter text-lg font-semibold">
                    {{ $trx->created_at->isoFormat('dddd, DD MMMM YYYY - HH:mm') . ' WIB' }}
                </h4>
            </div>
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm text-gray-500 italic">Waktu Pembayaran</p>
                <h4 class="font-inter text-lg font-semibold">
                    {{ $trx->pay_at ? \Carbon\Carbon::parse($trx->pay_at)->isoFormat('dddd, DD MMMM YYYY - HH:mm') . ' WIB' : '-' }}
                </h4>
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
                        class="px-3 py-1 {{ $trx->status_bayar !== 'menunggu pembayaran' ? 'hidden' : '' }} rounded bg-yellow-500 hover:bg-yellow-600 font-bold text-white ">Bayar</a>
                </div>
            </div>
        </div>
        <h3 class="font-bold text-2xl pt-3">Informasi Penerima</h3>
        <hr class="mb-3">
        <div class="grid grid-cols-2 gap-2 space-y-2 md:space-y-0 mb-6">
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
            <div class="col-span-2">
                <p class="text-sm text-gray-500 italic">Status Pengiriman</p>
                <ol class="flex items-center w-full space-x-4 mt-2">
                    <li
                        class="flex w-full items-center text-fg-brand after:content-[''] after:w-full after:h-1 after:border-b {{ $trx->status_bayar == 'berhasil' ? 'after:border-green-300' : 'after:border-gray-300' }} after:border-4 after:inline-block after:ms-4 after:rounded-full">
                        <span data-tooltip-target="pembayaran" data-tooltip-placement="bottom"
                            class="flex items-center cursor-pointer justify-center w-10 h-10 border {{ $trx->status_bayar == 'berhasil' ? 'bg-green-200 text-green-800 border-green-500' : 'bg-yellow-200 text-yellow-800 border-yellow-500' }} rounded-full lg:h-12 lg:w-12 shrink-0">
                            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 8H5m12 0a1 1 0 0 1 1 1v2.6M17 8l-4-4M5 8a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.6M5 8l4-4 4 4m6 4h-4a2 2 0 1 0 0 4h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1Z" />
                            </svg>
                        </span>
                        <div id="pembayaran" role="tooltip"
                            class="absolute z-10 {{ $trx->status_bayar == 'berhasil' ? 'invisible opacity-0' : '' }} inline-block px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded shadow-xs  tooltip">
                            Selesaikan Pembayaran
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </li>
                    <li
                        class="flex w-full items-center text-fg-brand after:content-[''] after:w-full after:h-1 after:border-b after:border-brand-subtle after:border-4 after:inline-block after:ms-4 after:rounded-full">
                        <span data-tooltip-target="dikemas" data-tooltip-placement="bottom"
                            class="flex items-center justify-center w-10 h-10 border {{ $trx->status_bayar == 'berhasil' ? ($trx->trackings && $trx->trackings->status !== 'sedang dikemas' ? 'bg-green-200 text-green-800 border-green-500' : 'bg-yellow-200 text-yellow-800 border-yellow-500') : 'bg-gray-200 text-gray-800' }} rounded-full lg:h-12 lg:w-12 shrink-0">
                            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.013 6.175 7.006 9.369l5.007 3.194-5.007 3.193L2 12.545l5.006-3.193L2 6.175l5.006-3.194 5.007 3.194ZM6.981 17.806l5.006-3.193 5.006 3.193L11.987 21l-5.006-3.194Z" />
                                <path
                                    d="m12.013 12.545 5.006-3.194-5.006-3.176 4.98-3.194L22 6.175l-5.007 3.194L22 12.562l-5.007 3.194-4.98-3.211Z" />
                            </svg>
                        </span>
                        <div id="dikemas" role="tooltip"
                            class="absolute z-10 {{ $trx->trackings && $trx->trackings->status !== 'sedang dikemas' ? 'invisible opacity-0' : ($trx->status_bayar == 'berhasil' ? '' : 'invisible opacity-0') }} inline-block px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded shadow-xs  tooltip">
                            Sedang Dikemas
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </li>
                    <li
                        class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-default after:border-4 after:inline-block  after:ms-4 after:rounded-full">
                        <span
                            class="flex items-center justify-center w-10 h-10 bg-neutral-tertiary rounded-full lg:h-12 lg:w-12 shrink-0">
                            <svg class="w-5 h-5 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 9h3m-3 3h3m-3 3h3m-6 1c-.306-.613-.933-1-1.618-1H7.618c-.685 0-1.312.387-1.618 1M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm7 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                            </svg>
                        </span>
                    </li>
                    <li class="flex items-center w-full">
                        <span
                            class="flex items-center justify-center w-10 h-10 bg-neutral-tertiary rounded-full lg:h-12 lg:w-12 shrink-0">
                            <svg class="w-5 h-5 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z" />
                            </svg>
                        </span>
                    </li>
                </ol>
            </div>
        </div>
        <div class="overflow-auto rounded shadow-lg mt-16">
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