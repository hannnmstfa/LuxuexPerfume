<x-app-layout title="Detail Transaksi {{ $trx->kodeTrx }}">
    <div class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Detail Transaksi</h5>
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                            <svg class="w-3 h-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('admTrx.index') }}"
                                class="ms-1 text-sm font-medium hover:text-blue-600 text-gray-500 md:ms-2">Transaksi</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-[600] text-yellow-500 md:ms-2">{{ $trx->kodeTrx }}</span>
                        </div>
                    </li>
                </ol>
            </div>
            <div>
                @if ($trx->status_bayar == 'berhasil')
                    <button
                        class="border rounded-full py-1 px-3 text-sm font-semibold shadow {{ $trx->trackings->status == 'pengiriman selesai' ? 'bg-green-200 text-green-900 border-green-300' : 'bg-yellow-200 text-yellow-900 border-yellow-300'}}">{{ ucwords($trx->trackings->status) }}</button>
                @else
                    <button
                        class="border rounded-full py-1 px-3 text-sm font-semibold shadow bg-gray-200 border-gray-300 {{ $trx->status_bayar == 'gagal' ? 'bg-red-200 text-red-600 border-red-300' : ($trx->status_bayar == 'menunggu pembayaran' ? 'bg-yellow-200 text-yellow-600 border-yellow-300' : '')}}">{{ ucwords($trx->status_bayar) }}</button>
                @endif
            </div>
        </div>
    </div>
    <div class="lg:grid grid-cols-3 gap-4 mt-5 space-y-3 md:space-y-0 w-full">
        <div class="col-span-2 flex flex-col gap-4">
            <div class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 p-3 border">
                <h1 class="text-lg font-semibold">Item yang Dibeli</h1>
                <hr class="my-2 border-gray-300 dark:border-gray-600">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-yellow-800 dark:bg-gold text-white text-left">
                                <th class="w-max"></th>
                                <th class="py-1 px-2">Produk</th>
                                <th class="py-1 px-2">Harga</th>
                                <th class="py-1 px-2">Jumlah</th>
                                <th class="text-right py-1 px-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trx->transaksi_items as $item)
                                <tr class="border-b odd:bg-white even:bg-yellow-50 dark:odd:bg-gray-800/40 dark:even:bg-gray-700/40 dark:backdrop-blur">
                                    <td class="py-1 px-2 size-20 block">
                                        <img src="{{ asset($item->produks->path_foto) }}" alt="{{ $item->produks->nama }}"
                                            class=" size-16 object-cover rounded-md border">
                                    </td>
                                    <td class=" py-1 px-2">
                                        <p class="font-semibold text-nowrap">{{ $item->produks->nama }}</p>
                                        <p
                                            class="text-xs border rounded-full w-max py-1 px-2 {{ $item->produks->kategori == 'pria' ? 'bg-gray-800 text-white' : 'bg-pink-600 text-white' }}">
                                            {{ ucwords($item->produks->kategori) }}
                                        </p>
                                    </td>
                                    <td class=" py-1 px-2">Rp{{ number_format($item->harga) }}</td>
                                    <td class=" py-1 px-2">{{ $item->jumlah }}</td>
                                    <td class="text-right py-1 px-2">Rp{{ number_format($item->subtotal) }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-yellow-100 dark:text-black text-right font-bold text-lg border-b">
                                <td colspan="4" class="py-1 px-2">Total:</td>
                                <td class=" py-1 px-2">
                                    Rp{{ number_format($trx->subtotal) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 p-3 border">
                <div class="flex-row items-center justify-between space-y-2 sm:flex sm:space-y-0 sm:space-x-4">
                    <h1 class="text-lg font-semibold">Tracking Pengiriman</h1>
                    <div class="flex flex-col md:flex-row justify-start items-start md:items-center gap-2">
                        @if ($trx->trackings)
                            <div
                                class="text-xs w-max font-semibold shadow border rounded py-1 px-2 {{ $trx->trackings->status == 'pengiriman selesai' ? 'border-green-600 text-green-600 bg-green-100' : 'border-yellow-500 text-yellow-500 bg-yellow-100' }}">
                                {{ ucwords($trx->trackings->status) }}</div>
                            @if (!$trx->trackings->resi)
                                <button data-modal-target="resi" data-modal-toggle="resi"
                                    class="font-inter rounded shadow py-1 px-3 font-bold bg-yellow-500 hover:bg-yellow-600 text-white">Input
                                    Resi</button>
                            @else
                                <button data-modal-target="resi" data-modal-toggle="resi" class="hidden"></button>
                                <button data-confirm-modal="true" data-icon="warning" data-title="Ubah Nomor Resi?"
                                    data-caption="Mengubah nomor resi berpengaruh dengan hasil tracking. Apakah anda ingin melanjutkan?"
                                    data-color="orange" data-modal="resi"
                                    class="font-inter rounded shadow py-1 px-3 font-bold bg-yellow-500 hover:bg-yellow-600 text-white">Edit
                                    Resi</button>
                            @endif
                        @endif
                    </div>
                </div>
                <hr class="my-2 border-gray-300 dark:border-gray-600">
                @if (!$trx->trackings)
                    <p class="text-center italic text-sm font-semibold text-red-600">Tagihan belum dibayar</p>
                @else
                    @if (!$trx->trackings->resi)
                        <p class="text-center italic text-sm font-semibold text-red-600">No.Resi belum ditambahkan</p>
                    @else
                        @if($trx->trackings->trackings_details->count() == 0)
                            <div class="text-center text-sm">Track belum ada. Pastikan nomor resi sudah benar.</div>
                        @else
                            @foreach ($trx->trackings->trackings_details as $index => $track)
                                <div
                                    class="{{ $index == 0 ? 'text-yellow-700 dark:text-gold' : ' text-gray-600 dark:text-gray-300' }} border-b w-full rounded flex p-3 gap-3 justify-start items-center">
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
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                        @endif
                    @endif
                @endif
            </div>
        </div>
        <div class="col-span-1 flex flex-col gap-4">
            <div class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 p-3 border">
                <h1 class="text-lg font-semibold">Rincian Pemesan</h1>
                <hr class="my-2 border-gray-300 dark:border-gray-600">
                <p class="text-sm font-bold">{{ $trx->users->name ?? 'deleted user' }}</p>
                <p class="text-sm">{{ $trx->users->phone ?? 'deleted user' }}</p>
                <p class="text-sm">{{ $trx->users->email ?? 'deleted user' }}</p>
            </div>
            <div class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 p-3 border">
                <h1 class="text-lg font-semibold">Rincian Penerima</h1>
                <hr class="my-2 border-gray-300 dark:border-gray-600">
                <p class="text-sm font-bold">{{ $trx->transaksi_details->nama_penerima }}</p>
                <p class="text-sm">{{ $trx->transaksi_details->no_penerima }}</p>
                <p class="text-sm">{{ $trx->transaksi_details->alamat_penerima }}</p>
                <!-- <div class="flex relative justify-start items-center gap-2 mt-2">
                    <p class="text-nowrap w-max bg-indigo-300 font-bold text-sm border border-indigo-500 rounded-full py-1 px-2"
                        title="Kode Area">{{ $trx->transaksi_details->kode_area }}</p>
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
                        Kode Area
                        <p class="text-sm">*Didapatkan saat pengguna memilih wilayah saat checkout. Kode area ini resmi
                            dan
                            sesuai dengan Kepmendagri No 300.2.2-2138 Tahun 2025</p>
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div> -->
            </div>
            <div class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 p-3 border">
                <div class="flex-row items-center justify-between space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                    <h1 class="text-lg font-semibold">Rincian Pembayaran</h1>
                </div>
                <hr class="my-2 border-gray-300 dark:border-gray-600">
                <div class="flex justify-between items-center">
                    <p class="text-sm font-semibold text-gray-500">Tripay Reff</p>
                    <p class=" font-semibold text-gray-900 dark:text-white">{{ $trx->tripay_ref }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <p class="text-sm font-semibold text-gray-500">Total Bayar</p>
                    <div class="flex justify-end items-center gap-1">
                        <button data-tooltip-target="rincian_harga" type="button">
                            <svg class="w-4 h-4 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <p class="font-bold text-gray-900 dark:text-white">
                            Rp{{ number_format($trx->total_harga + $trx->fee_payment) }}</p>
                    </div>
                    <div id="rincian_harga" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-700 rounded shadow-xs opacity-0 tooltip">
                        Rincian Harga:
                        <ul class="list-disc pl-5">
                            <li>Subtotal: Rp{{ number_format($trx->subtotal) }}</li>
                            <li>Ongkir: Rp{{ number_format($trx->ongkir) }}</li>
                            <li>Fee payment: Rp{{ number_format($trx->fee_payment) }}</li>
                        </ul>
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <p class="text-sm font-semibold text-gray-500">Metode Pembayaran</p>
                    <p class=" font-semibold text-gray-900 dark:text-white">{{ $trx->metode_bayar }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <p class="text-sm font-semibold text-gray-500">Status</p>
                    @if ($trx->status_bayar == 'berhasil')
                        <button
                            class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full dark:bg-green-900 dark:text-green-300">
                            BERHASIL
                        </button>
                    @else
                        <button
                            class="px-2 py-1 text-xs font-semibold text-nowrap {{ $trx->status_bayar == 'kadaluarsa' ? 'bg-gray-500 text-white' : '' }} {{ $trx->status_bayar == 'menunggu pembayaran' ? 'text-yellow-800 bg-yellow-200' : '' }} {{ $trx->status_bayar == 'gagal' ? 'text-red-800 bg-red-200' : '' }} rounded-full">
                            {{ strtoupper($trx->status_bayar) }}
                        </button>
                    @endif
                </div>
                <div class="flex justify-between items-center">
                    <p class="text-sm font-semibold text-gray-500">Waktu Bayar</p>
                    <p class=" font-semibold text-gray-900 dark:text-white">{{ $trx->pay_at ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    @if ($trx->trackings)
        <!-- Modal Resi -->
        <div id="resi" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Resi Pengiriman
                        </h3>
                        <button type="button"
                            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="resi">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form action="{{ route('admTrx.tracking', $trx->kodeTrx) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="layanan" class="font-medium text-sm">Nama Layanan<span
                                        class="text-red-600">*</span></label>
                                <select name="layanan" id="layanan" class="block w-full text-sm rounded border-gray-300 dark:bg-gray-800 dark:border-gray-500"
                                    required>
                                    <option value="" selected disabled>-- Pilih Layanan --</option>
                                    <option value="jne" {{ old('layanan', $trx->trackings->ekspedisi) == 'jne' ? 'selected' : '' }}>JNE</option>
                                    <option value="sicepat" {{ old('layanan', $trx->trackings->ekspedisi) == 'sicepat' ? 'selected' : '' }}>SiCepat
                                    </option>
                                    <option value="ninja" {{ old('layanan', $trx->trackings->ekspedisi) == 'ninja' ? 'selected' : '' }}>Ninja</option>
                                    <option value="jnt" {{ old('layanan', $trx->trackings->ekspedisi) == 'jnt' ? 'selected' : '' }}>J&T Express</option>
                                    <option value="pos" {{ old('layanan', $trx->trackings->ekspedisi) == 'pos' ? 'selected' : '' }}>POS Indonesia</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="resi" class="font-medium text-sm">Nomor Resi<span
                                        class="text-red-600">*</span></label>
                                <input type="text" class="rounded w-full border-gray-300 text-sm dark:bg-gray-800 dark:border-gray-500" name="resi"
                                    value="{{ old('resi', $trx->trackings->resi) }}"
                                    placeholder="Masukkan No Resi dari pengiriman" required>
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan
                                Resi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>