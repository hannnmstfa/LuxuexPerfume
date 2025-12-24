<x-guest-layout title="{{ $produk->nama }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-md rounded-lg p-6 flex flex-col md:flex-row gap-6">
            <div class="md:w-1/2">
                <img src="{{ asset('storage/produk/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
                    class="w-full h-auto rounded-lg">
            </div>
            <div class="md:w-1/2 flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-4">{{ $produk->nama }}</h1>
                    <p class="text-gray-700 mb-4">{{ $produk->deskripsi }}</p>
                    <p class="text-xl font-semibold text-yellow-600 mb-4">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <p class="text-gray-600">Stok Tersedia: {{ $produk->stocks->jumlah ?? 0 }}</p>
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