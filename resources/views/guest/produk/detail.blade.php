<x-guest-layout title="{{ $produk->nama }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-md rounded-lg p-6 flex flex-col md:flex-row gap-6">
            <div class=" md:w-1/2 flex justify-center items-center">
                <img src="{{ asset($produk->path_foto) }}" alt="{{ $produk->nama }}"
                    class="size-72 h-auto rounded-lg shadow-lg">
            </div>
            <div class="md:w-1/2 flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-4">{{ $produk->nama }}</h1>
                    <p class="text-gray-700 mb-4">{{ $produk->deskripsi }}</p>
                    <p class="text-xl font-semibold text-yellow-600 mb-4">Rp
                        {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <p class="text-gray-600"><span
                            class="{{ $produk->stok < 1 ? 'text-red-600 border p-1 rounded bg-red-100 border-red-400' : '' }} font-semibold">{{ $produk->stok < 1 ? 'Stok Habis' : 'Stok tersisa: ' . $produk->stok }}</span>
                    </p>
                </div>
                <div class="mt-6">
                    <button wire:click="$emit('addKeranjang', {{ $produk->id }})"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>