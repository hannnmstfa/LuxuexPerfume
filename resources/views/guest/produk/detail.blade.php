<x-guest-layout title="{{ $produk->nama }}">
    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-black/50 backdrop-blur border rounded-lg border-gray-700">
        <div class="shadow-md rounded-lg p-6 flex flex-col md:flex-row gap-6">
            <div class=" md:w-1/2 flex justify-center items-center">
                <img src="{{ asset($produk->path_foto) }}" alt="{{ $produk->nama }}"
                    class="size-72 h-auto rounded-lg shadow-lg">
            </div>
            <div class="md:w-1/2 flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-4">{{ $produk->nama }}</h1>
                    <p class="text-gray-700 mb-4">{{ $produk->deskripsi }}</p>
                    <p class="text-xl font-semibold text-yellow-600 mb-4">Rp
                        {{ number_format($produk->harga, 0, ',', '.') }}
                    </p>
                    <p class="text-gray-600"><span
                            class="{{ $produk->stok < 1 ? 'text-red-600 border p-1 rounded bg-red-100 border-red-400' : '' }} font-semibold">{{ $produk->stok < 1 ? 'Stok Habis' : 'Stok tersisa: ' . $produk->stok }}</span>
                    </p>
                </div>
                <div class="mt-6">
                    <div class="relative flex items-center w-full shadow-xs mb-2">
                        <button type="button" id="tambah"
                            class="bg-gray-300 box-border border hover:bg-gray-400 focus:ring-2 font-medium leading-5 hover:text-white dark:bg-gray-900 dark:border-gray-600 text-sm px-3 focus:outline-none h-10">
                            <svg class="w-4 h-4 text-heading" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14" />
                            </svg>
                        </button>
                        <input type="text" id="jumlah" name="jumlah" min="1" value="1" readonly
                            class="block h-10 text-center border-gray-300 w-16 lg:w-full py-2.5 dark:bg-gray-900 dark:border-gray-600"
                            required />
                        <button type="button" id="kurang"
                            class="bg-gray-300 box-border border hover:bg-gray-400 focus:ring-2 font-medium leading-5 hover:text-white dark:bg-gray-900 dark:border-gray-600 text-sm px-3 focus:outline-none h-10">
                            <svg class="w-4 h-4 text-heading" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14m-7 7V5" />
                            </svg>
                        </button>
                    </div>
                    <button wire:click="$emit('addKeranjang', {{ $produk->id }})"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            const tambah = document.getElementById('')
        });
    </script>
</x-guest-layout>