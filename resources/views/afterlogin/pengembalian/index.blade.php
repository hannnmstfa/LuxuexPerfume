<x-guest-layout title="Detail Pengajuan {{ $data->transaksi->kodeTrx }}">
    <div class="max-w-7xl mx-auto px-6 py-10 md:py-12 text-center flex flex-col items-center gap-1">
        <h1 class="text-3xl md:text-4xl font-semibold tracking-tight">
            PENGEMBALIAN <span class="text-gold">{{ $data->transaksi->kodeTrx }}</span>
        </h1>
        <span class="text-sm font-inter mb-1">{{ ucwords($data->type) }}</span>
        <span
            class="border rounded-lg px-4 py-1 text-xs font-semibold bg-yellow-200 text-yellow-600 border-yellow-300 {{ $data->status == 'diterima' ? '!bg-green-200 !text-green-600 !border-green-400' : ($data->status == 'ditolak' ? '!text-red-600 !bg-red-200 !border-red-400' : '') }}">Pengajuan
            {{ ucwords($data->status) }}</span>
    </div>
    <div class="max-w-screen-xl mx-auto border-t border-gray-600 p-3 grid md:grid-cols-2 gap-8">
        <div class="col-span-1 mb-4">
            <div class="mb-3">
                <p class="text-xs text-gray-500 font-semibold uppercase">Deskripsi Pengembalian</p>
                <p class="text-justify text-sm">{{ $data->deskripsi }}</p>
            </div>
            <div class="mb-3">
                <p class="text-xs text-gray-500 font-semibold uppercase">Video Unboxing</p>
                <video src="{{ asset($data->video_unboxing) }}"
                    class="w-full max-h-64 rounded-lg border border-gray-800 shadow-xl mt-1" controls></video>
            </div>
        </div>
        <div x-data="{ open: false, imageUrl: '' }" class="col-span-1 mb-4">
            @if ($data->foto_pendukung)
                <div class="mb-3">
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
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" style="display: none;">
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
            <div class="mb-3">
                <p class="text-xs text-gray-500 font-semibold uppercase">Catatan dari Penjual</p>
                <p class="text-justify text-sm">{{ $data->catatan ?? '-' }}</p>
            </div>
        </div>
    </div>
</x-guest-layout>