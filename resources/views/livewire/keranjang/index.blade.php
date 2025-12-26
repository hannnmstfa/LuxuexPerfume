<div class="max-w-screen-xl mx-auto">
    <div class="grid grid-cols-12 gap-4 justify-center items-start space-y-2 md:space-y-0 p-3">
        <div class="col-span-12 md:col-span-8 relative overflow-x-auto">
            <table class="w-full font-inter text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-yellow-200 border-b border-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">
                            Produk
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keranjangs as $item)
                        <tr wire:key="{{ $item->id }}" class="odd:bg-white even:bg-gray-200 border-b border-gray-400 hover:bg-gray-300 relative">
                            <td class="px-6 py-4">
                                <button wire:click="hapusKeranjang({{ $item->id }})"
                                    class="flex justify-center items-center rounded p-2 hover:bg-red-300"
                                    title="Hapus Produk dari Keranjang">
                                    <svg class="w-6 h-6 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </button>
                            </td>
                            <td scope="row" class="px-6 py-4">
                                <div class="flex flex-col md:flex-row justify-start items-center gap-3">
                                    <img src="{{ asset($item->produks->path_foto) }}" alt="{{ $item->produks->nama }}"
                                        class="w-14 h-14 object-cover rounded" />
                                    <a href="{{ route('produk.detail', $item->produks->slug) }}"
                                        class="font-semibold hover:text-gray-400">{{ $item->produks->nama }}</a>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="relative flex items-center max-w-[9rem] shadow-xs">
                                    <button type="button" wire:click="kurangJumlah({{ $item->id }})"
                                        class="bg-gray-300 {{ $item->jumlah == 1 ? 'hidden' : '' }} box-border border border-default-medium hover:bg-gray-400 focus:ring-2 font-medium leading-5 hover:text-white text-sm px-3 focus:outline-none h-10">
                                        <svg class="w-4 h-4 text-heading" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 12h14" />
                                        </svg>
                                    </button>
                                    <input type="text" min="1" value="{{ $item->jumlah }}" readonly
                                        class="block h-10 text-center border-gray-300 w-16 lg:w-full py-2.5 " required />
                                    <button type="button" wire:click="addJumlah({{ $item->id }})"
                                        class="bg-gray-300 box-border border border-default-medium hover:bg-gray-400 focus:ring-2 font-medium leading-5 hover:text-white text-sm px-3 focus:outline-none h-10">
                                        <svg class="w-4 h-4 text-heading" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 12h14m-7 7V5" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-semibold">
                                Rp{{ number_format(($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah) }}
                            </td>
                            <td wire:loading.remove.class="hidden" wire:loading.class="flex" wire:target="addJumlah({{ $item->id }}), kurangJumlah({{ $item->id }}), hapusKeranjang({{ $item->id }})"
                                class="absolute w-full top-0 left-0 right-0 bottom-0 bg-gray-500 hidden justify-center items-center bg-opacity-50">
                                <x-loader />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Keranjang Anda masih kosong</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
        <div class="col-span-12 md:col-span-4">
            <div class="border border-gray-300 rounded-md p-4 shadow-md relative">
                <div wire:loading.remove.class="hidden" wire:loading.class="flex"
                    class="absolute top-0 left-0 right-0 bottom-0 bg-gray-500 hidden justify-center items-center bg-opacity-50">
                    <x-loader />
                </div>
                <h2 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h2>
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span class="font-semibold">
                        Rp {{ number_format($subtotal) }}
                    </span>
                </div>
                <div class="flex justify-between mb-4">
                    <span>Ongkir</span>
                    <span class="font-semibold">Rp {{ number_format($ongkir) }}</span>
                </div>
                <div class="flex justify-between border-t pt-2 font-semibold">
                    <span>Total</span>
                    <span>
                        Rp {{ number_format($total) }}
                    </span>
                </div>
                <button
                    class="w-full mt-4 bg-yellow-800 hover:bg-yellow-700 text-gray-50 font-semibold py-2 px-4 rounded-md">Lanjutkan
                    ke Pembayaran</button>

            </div>
        </div>
    </div>
</div>