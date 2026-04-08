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
                                class="ms-1 text-sm font-[600] text-yellow-500 md:ms-2">{{ $data->transaksi->kodeTrx }}</span>
                        </div>
                    </li>
                </ol>
            </div>
            <button
                class="border rounded-full py-1 px-3 text-sm font-semibold shadow {{ $data->status == 'disetujui' ? 'bg-green-200 text-green-900 border-green-300' : 'bg-yellow-200 text-yellow-900 border-yellow-300'}}">{{ ucwords($data->type . ' - ' . $data->status) }}</button>
        </div>
    </div>
    <div
        class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur border dark:border-gray-700 p-3 mt-5">
        <div class="mb-4">
            <p class="text-xs text-gray-500 font-semibold uppercase">Waktu Pengajuan</p>
            <p class="text-justify text-sm">{{ $data->created_at->isoFormat('ddd, DD MMMM YYYY - HH:mm') }} WIB</p>
        </div>
        <div class="mb-4">
            <p class="text-xs text-gray-500 font-semibold uppercase">Deskripsi Pengembalian</p>
            <p class="text-justify text-sm">{{ $data->deskripsi }}</p>
        </div>
        <div class="mb-4">
            <p class="text-xs text-gray-500 font-semibold uppercase">Video Unboxing</p>
            <video src="{{ asset($data->video_unboxing) }}"
                class="w-full max-h-64 rounded-lg border border-gray-800 shadow-xl mt-1" controls></video>
        </div>
        <div x-data="{ open: false, imageUrl: '' }" class="mb-4">
            @if ($data->foto_pendukung)
                <div class="mb-4">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Foto Pendukung</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 mt-2 gap-3">
                        @foreach ($data->foto_pendukung as $i => $foto_pendukung)
                            <div class="relative w-full h-28 overflow-hidden rounded-lg border border-gray-700 shadow-sm">
                                <img src="{{ asset($foto_pendukung) }}" alt="Foto-{{ $i + 1 }}"
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
        <div class="mb-4">
            <p class="text-xs text-gray-500 font-semibold uppercase">Catatan dari Penjual</p>
            <p class="text-justify text-sm">{{ $data->catatan ?? '-' }}</p>
        </div>
    </div>
</x-app-layout>