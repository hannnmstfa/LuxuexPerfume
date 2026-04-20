<x-app-layout title="Detail Pengembalian {{ $data->transaksi->kodeTrx }}">
    <div
        class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Detail Pengajuan Pengembalian</h5>
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
                            <a href="{{ route('admReturn.index') }}"
                                class="ms-1 text-sm font-medium hover:text-blue-600 text-gray-500 md:ms-2">Pengembalian</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span
                                class="ms-1 text-sm font-[600] text-yellow-500 md:ms-2 uppercase">#{{ $data->return_code }}</span>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="flex flex-col justify-center items-center gap-1">
                <button
                    class="border rounded-full py-1 px-3 text-sm font-semibold shadow {{ $data->status == 'disetujui' ? 'bg-green-200 text-green-900 border-green-300' : ($data->status == 'ditolak' ? 'bg-red-200 text-red-900 border-red-300' : 'bg-yellow-200 text-yellow-900 border-yellow-300') }}">{{ ucwords($data->type . ' - ' . $data->status) }}</button>
                <span class="text-xs">Last Update: {{ $data->updated_at }}</span>
            </div>
        </div>
    </div>
    <div
        class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur border dark:border-gray-700 p-3 mt-5">
        <div class="flex-row items-center justify-between space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <h3 class="text-lg">Ringkasan Pesanan</h3>
            <a href="{{ route('admTrx.show', $data->transaksi->kodeTrx) }}"
                class="flex items-center bg-gold rounded-lg py-1 px-3 text-yellow-900 justify-center font-semibold text-sm">
                <span>Detail</span>
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m9 5 7 7-7 7" />
                </svg>
            </a>
        </div>
        <hr class="my-2 border-gray-600">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="col-span-1">
                <div class="mb-4">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Kode Pesanan</p>
                    <p class="text-sm font-bold text-gold">{{ $data->transaksi->kodeTrx }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Informasi Pemesan</p>
                    <p class="text-sm">{{ $data->transaksi->users->name }}</p>
                    <p class="text-sm">{{ $data->transaksi->users->email }}</p>
                    <p class="text-sm">{{ $data->transaksi->users->phone }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Informasi Penerima</p>
                    <p class="text-sm">{{ $data->transaksi->transaksi_details->nama_penerima }}</p>
                    <p class="text-sm">{{ $data->transaksi->transaksi_details->no_penerima }}</p>
                    <p class="text-sm">{{ $data->transaksi->transaksi_details->alamat_penerima }}</p>
                </div>
            </div>
            <div class="col-span-1 mb-4">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="text-gray-400 text-sm">Subtotal</td>
                            <td class="text-right font-inter font-semibold">
                                Rp{{ number_format($data->transaksi->subtotal) }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-400 text-sm">Ongkir</td>
                            <td class="text-right font-inter font-semibold">
                                Rp{{ number_format($data->transaksi->ongkir) }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-400 text-sm">Fee Payment</td>
                            <td class="text-right font-inter font-semibold">
                                Rp{{ number_format($data->transaksi->fee_payment) }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-400 text-sm">Total</td>
                            <td class="text-right font-inter font-semibold">
                                Rp{{ number_format($data->transaksi->total_harga + $data->transaksi->fee_payment) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-400 text-sm">Metode Pembayaran</td>
                            <td class="text-right font-inter font-semibold">{{ $data->transaksi->metode_bayar }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-400 text-sm">Terbayar Pada</td>
                            <td class="text-right font-inter font-semibold">
                                {{ $data->transaksi->pay_at->isoFormat('dddd, DD MMMM YYYY - HH:mm') }} WIB
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div
        class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur border dark:border-gray-700 p-3 mt-5">
        <div class="flex-row items-center justify-between space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <h3 class="text-lg">Ringkasan Pengembalian</h3>
            <button type="button" data-modal-target="prosesModal" data-modal-toggle="prosesModal"
                class="bg-gold text-black {{ $data->catatan ? '' : 'hidden' }} rounded-lg py-1 px-3 font-bold border border-yellow-400 hover:cursor-pointer hover:opacity-85 flex items-center gap-2">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                </svg>
                <span>Edit Status</span>
            </button>
        </div>
        <hr class="my-2 border-gray-600">
        <div class="mb-4">
            <p class="text-xs text-gray-500 font-semibold uppercase">Waktu Pengajuan</p>
            <p class="text-justify text-sm">{{ $data->created_at->isoFormat('dddd, DD MMMM YYYY - HH:mm') }} WIB <span
                    class="text-gray-600 text-xs italic">({{ $data->created_at->diffForHumans() }})</span></p>
        </div>
        <div class="mb-4">
            <p class="text-xs text-gray-500 font-semibold uppercase">Deskripsi Pengembalian</p>
            <p class="text-justify text-sm">{{ $data->deskripsi }}</p>
        </div>
        <div class="mb-4">
            <p class="text-xs text-gray-500 font-semibold uppercase">Video Unboxing</p>
            <video src="{{ asset($data->video_unboxing) }}" loading="lazy"
                class="w-full max-h-64 rounded-lg border border-gray-800 shadow-xl mt-1" controls></video>
        </div>
        <div x-data="{ open: false, imageUrl: '' }" class="mb-4">
            @if ($data->foto_pendukung)
                <div class="mb-4">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Foto Pendukung</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 mt-2 gap-3">
                        @foreach ($data->foto_pendukung as $i => $foto_pendukung)
                            <div class="relative w-full h-28 overflow-hidden rounded-lg border border-gray-700 shadow-sm">
                                <img src="{{ asset($foto_pendukung) }}" alt="Foto-{{ $i + 1 }}" loading="lazy"
                                    class="w-full h-full object-cover cursor-pointer hover:scale-105 transition duration-200"
                                    @click="open = true; imageUrl = '{{ asset($foto_pendukung) }}'">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Modal Preview -->
                <template x-teleport="body">
                    <div x-show="open" x-transition @click.self="open = false" @keydown.escape.window="open = false"
                        class="fixed inset-0 !z-[100] flex items-center justify-center bg-black/80 p-4"
                        style="display: none;">
                        <button type="button" @click="open = false"
                            class="absolute top-10 right-10 text-white text-3xl font-bold">
                            &times;
                        </button>
                        <div class="relative max-w-4xl w-full flex flex-col justify-center items-center">
                            <img :src="imageUrl" alt="Preview" class="max-h-[85vh] max-w-full rounded-lg shadow-lg border">
                        </div>
                    </div>
                </template>
            @endif
        </div>
    </div>
    <div class="mt-5 bg-gray-100 dark:bg-black/50 dark:backdrop-blur">
        <button type="button" data-modal-target="prosesModal" data-modal-toggle="prosesModal"
            class="bg-gold {{ $data->catatan ? 'hidden' : '' }}  w-full text-black rounded-lg py-2 font-bold border border-yellow-400 hover:cursor-pointer hover:opacity-85">Proses
            Pengajuan</button>
    </div>

    <!-- Modal Proses -->
    <div id="prosesModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full animate-swipeDown scroll-style">
        <div class="relative p-4 w-full max-w-screen-lg max-h-full">
            <!-- Modal content -->
            <div class="relative bg-gray-800 border border-gray-600 rounded-lg shadow-sm p-4 md:p-6 ">
                <!-- Modal header -->
                <div class="flex items-center justify-between border-b border-gray-600 pb-4 md:pb-5">
                    <h3 class="text-lg text-gold font-bold">
                        Proses Pengajuan
                    </h3>
                    <button type="button"
                        class=" hover:bg-gray-500 hover:opacity-80 text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="prosesModal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="form" action="{{ route('admReturn.update', $data->return_code) }}" method="post" class="py-3">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <p class="font-semibold mb-2">Status<span class="text-red-500">*</span></p>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="col-span-1">
                                <input type="radio" name="status" id="disetujui" value="disetujui" class="hidden peer"
                                    {{ $data->status == 'disetujui' ? 'checked' : '' }} required>
                                <label for="disetujui"
                                    class="border rounded py-4 text-sm font-bold border-gray-500 flex justify-center items-center bg-gray-900 shadow text-green-400 hover:cursor-pointer hover:opacity-85 peer-checked:border-green-500 peer-checked:border-2">
                                    Terima Pengajuan
                                </label>
                            </div>
                            <div class="col-span-1">
                                <input type="radio" name="status" id="ditolak" value="ditolak" class="hidden peer" {{ $data->status == 'ditolak' ? 'checked' : '' }} required>
                                <label for="ditolak"
                                    class="border  rounded py-4 text-sm font-bold border-gray-500 flex justify-center items-center bg-gray-900 shadow text-red-400 hover:cursor-pointer hover:opacity-85 peer-checked:border-red-500 peer-checked:border-2">
                                    Tolak Pengajuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="font-semibold mb-2">Catatan<span class="text-red-500">*</span></p>
                        <textarea name="konten" id="konten" hidden>{{ old('konten', $data->catatan) }}</textarea>
                        <div id="loader">
                            <x-loader />
                        </div>
                        <x-quill-editor />
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end border-t border-gray-600 space-x-4 pt-4">
                        <button data-modal-hide="prosesModal" type="button"
                            class="text-white bg-gray-900 rounded-lg border border-gray-600 shadow-xs text-sm px-4 py-2.5 hover:opacity-85">Batal</button>
                        <button type="submit"
                            class="text-black rounded-lg font-bold bg-gold border border-gray-600 shadow text-sm px-4 py-2.5 hover:opacity-85">{{ $data->catatan ? 'Simpan Perubahan' : 'Proses' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>