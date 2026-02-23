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
                        class="flex w-full items-center text-fg-brand after:content-[''] after:w-full after:h-1 after:border-b {{ $trx->status_bayar == 'berhasil' && $trx->trackings->status !== 'sedang dikemas' ? 'after:border-green-300' : 'after:border-gray-300' }} after:border-4 after:inline-block after:ms-4 after:rounded-full">
                        <span data-tooltip-target="dikemas" data-tooltip-placement="bottom"
                            class="flex items-center justify-center w-10 h-10 border {{ $trx->status_bayar == 'berhasil' ? ($trx->trackings && $trx->trackings->status !== 'sedang dikemas' ? 'bg-green-200 text-green-800 border-green-500' : 'bg-yellow-200 text-yellow-800 border-yellow-500') : 'bg-gray-200 text-gray-800' }} rounded-full lg:h-12 lg:w-12 shrink-0">
                            <i class="fa-regular fa-box"></i>
                        </span>
                        <div id="dikemas" role="tooltip"
                            class="absolute z-10 {{ $trx->trackings && $trx->trackings->status !== 'sedang dikemas' ? 'invisible opacity-0' : ($trx->status_bayar == 'berhasil' ? '' : 'invisible opacity-0') }} inline-block px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded shadow-xs  tooltip">
                            Sedang Dikemas
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </li>
                    <li
                        class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b {{ $trx->status_bayar == 'berhasil' && $trx->trackings->status == 'pengiriman selesai' ? 'after:border-green-300' : 'after:border-gray-300' }} after:border-4 after:inline-block  after:ms-4 after:rounded-full">
                        <span data-tooltip-target="pengiriman" data-tooltip-placement="bottom"
                            class="flex items-center justify-center w-10 h-10 border {{ $trx->status_bayar == 'berhasil' && $trx->trackings->status !== 'sedang dikemas' ? ($trx->trackings && $trx->trackings->status == 'dalam pengiriman' ? 'bg-yellow-200 text-yellow-800 border-yellow-500' : 'bg-green-200 text-green-800 border-green-500') : 'bg-gray-200 text-gray-800' }} rounded-full lg:h-12 lg:w-12 shrink-0">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                            </svg>
                        </span>
                        <div id="pengiriman" role="tooltip"
                            class="absolute z-10 {{ $trx->trackings && $trx->trackings->status !== 'dalam pengiriman' ? 'invisible opacity-0' : ($trx->status_bayar == 'berhasil' ? '' : 'invisible opacity-0') }} inline-block px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded shadow-xs  tooltip">
                            Dalam Pengiriman
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <span data-tooltip-target="selesai" data-tooltip-placement="bottom"
                            class="flex items-center justify-center w-10 h-10 border {{ $trx->status_bayar == 'berhasil' && $trx->trackings->status == 'pengiriman selesai' ? 'bg-green-200 text-green-800 border-green-500' : 'bg-gray-200 text-gray-800' }} rounded-full lg:h-12 lg:w-12 shrink-0">
                            <svg class="w-5 h-5 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z" />
                            </svg>
                        </span>
                        <div id="selesai" role="tooltip"
                            class="absolute z-10 {{ $trx->trackings && $trx->trackings->status == 'pengiriman selesai' ? '' : ($trx->status_bayar == 'berhasil' ? 'invisible opacity-0' : 'invisible opacity-0') }} inline-block px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded shadow-xs  tooltip">
                            Pesanan diterima
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </li>
                </ol>
                <div
                    class="w-full {{ $trx->status_bayar == 'berhasil' && $trx->trackings->status !== 'sedang dikemas' ? 'flex' : 'hidden' }} justify-center items-center">
                    <button data-modal-target="tracking" data-modal-toggle="tracking"
                        class="flex text-nowrap text-sm text-white bg-yellow-600 font-semibold py-2 px-4 rounded hover:bg-yellow-700 mt-4">Detail
                        Pengiriman</button>
                </div>
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

    <!-- Modal Trackings -->
    @if ($trx->trackings && $trx->trackings->status !== 'sedang dikemas')
        <div id="tracking" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-gray-50 border border-gray-300 rounded-xl shadow-sm p-4 md:p-6">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                        <div class="md:flex justify-start items-center gap-3">
                            <h3 class="text-lg font-bold">
                                Rincian Pengiriman
                            </h3>
                            <span
                                class="text-xs font-semibold shadow border rounded py-1 px-2 {{ $trx->trackings->status == 'pengiriman selesai' ? 'border-green-600 text-green-600 bg-green-100' : 'border-yellow-500 text-yellow-500 bg-yellow-100' }}">{{ ucwords($trx->trackings->status) }}</span>
                        </div>
                        <button type="button"
                            class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="tracking">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18 17.94 6M18 18 6.06 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="space-y-4 md:space-y-6 py-4 md:py-6 overflow-auto">
                        <div class="flex justify-start items-center gap-2">
                            <h4 class="text-xs text-nowrap">No Resi:</h4>
                            <div class="w-full">
                                <div class=" relative">
                                    <label for="resipengiriman" class="sr-only">Label</label>
                                    <input id="resipengiriman" type="text"
                                        class="col-span-6 bg-gray-100 border border-gray-200 font-semibold text-sm rounded focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                        value="{{ $trx->trackings->resi }}" disabled readonly>
                                    <button data-copy-to-clipboard-target="resipengiriman" class="absolute flex
                                                                        items-center end-1.5 top-1/2 -translate-y-1/2 text-body bg-gray-50
                                                                        border border-gray-200 hover:bg-neutral-secondary-strong/70 hover:text-heading
                                                                        focus:ring-1 focus:ring-yellow-700 font-medium leading-5 rounded text-xs
                                                                        px-3 py-1.5 focus:outline-none">
                                        <span id="default-message">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 me-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                                                </svg>
                                                <span class="text-xs font-semibold">Salin</span>
                                            </span>
                                        </span>
                                        <span id="success-message" class="hidden">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 text-fg-brand me-1.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z" />
                                                </svg>
                                                <span class="text-xs font-semibold text-fg-brand">Tersalin</span>
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @foreach ($trx->trackings->trackings_details as $index => $track)
                            <div class="{{ $index == 0 ? 'text-yellow-700' : ' text-gray-600' }} border-b w-full rounded flex p-3
                                                                                    gap-3 justify-start items-center">
                                <div>
                                    @if ($index == 0 && $trx->trackings->status == 'pengiriman selesai')
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold">{{ $track->deskripsi }}</p>
                                    <p class="text-[10px] text-gray-500">{{ $track->created_at }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const copyBtn = document.querySelector('[data-copy-to-clipboard-target="resipengiriman"]');
                const defaultMessage = document.getElementById('default-message');
                const successMessage = document.getElementById('success-message');
                if (copyBtn) {
                    copyBtn.addEventListener('click', function () {
                        setTimeout(() => {
                            showSuccess();
                            setTimeout(() => {
                                resetToDefault();
                            }, 2000);
                        }, 100);
                    });
                }
                const showSuccess = () => {
                    defaultMessage.classList.add('hidden');
                    successMessage.classList.remove('hidden');
                    copyBtn.classList.add('border-yellow-700', 'text-yellow-700');
                }
                const resetToDefault = () => {
                    defaultMessage.classList.remove('hidden');
                    successMessage.classList.add('hidden');
                    copyBtn.classList.remove('border-yellow-700', 'text-yellow-700');
                }
            })
        </script>
    @endif
</x-guest-layout>