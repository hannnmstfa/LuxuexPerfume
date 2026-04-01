<div class="max-w-screen-xl mx-auto">
    <div class="grid grid-cols-12 gap-4 justify-center items-start space-y-2 lg:space-y-0 p-3">
        <div class="col-span-12 lg:col-span-8 relative overflow-x-auto">
            <table class="w-full font-inter text-sm text-left text-gray-500 dark:text-white">
                <thead class="text-xs text-gray-700 uppercase bg-yellow-200 dark:bg-gold dark:text-white border-b border-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3 text-center lg:text-left">
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
                        <tr
                            class=" border-b border-gray-400 {{ in_array($item->id, $errorStok) ? ' bg-red-200 dark:bg-red-600' : ' odd:bg-white even:bg-gray-200 dark:even:bg-black/80 dark:odd:bg-black/50 dark:backdrop-blur' }} hover:bg-gray-300 relative">
                            <td class="px-6 py-4">
                                <button wire:click="hapusKeranjang({{ $item->id }})"
                                    class="flex justify-center items-center rounded p-2 hover:bg-red-300 {{ in_array($item->id, $errorStok) ? 'dark:bg-red-300' : '' }} "
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
                                    <div class="text-center lg:text-left">
                                        <p class="font-semibold">{{ $item->produks->nama }}</p>
                                        <div class="text-xs text-gray-400">Stok tersisa:
                                            {{ $item->produks->stok }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p
                                class="text-xs text-red-500 italic line-through {{ $item->produks->harga_diskon !== null ? '' : 'hidden' }}">
                                Rp {{ number_format($item->produks->harga) }}</p>
                                <p>
                                    Rp{{ number_format($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="relative flex items-center max-w-[9rem] shadow-xs">
                                    <button type="button" wire:click="kurangJumlah({{ $item->id }})"
                                        class="bg-gray-300 {{ $item->jumlah == 1 ? 'hidden' : '' }} box-border border hover:bg-gray-400 focus:ring-2 font-medium leading-5 hover:text-white dark:bg-gray-900 dark:border-gray-600 text-sm px-3 focus:outline-none h-10">
                                        <svg class="w-4 h-4 text-heading" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 12h14" />
                                        </svg>
                                    </button>
                                    <input type="text" min="1" value="{{ $item->jumlah }}" readonly
                                        class="block h-10 text-center border-gray-300 w-16 lg:w-full py-2.5 dark:bg-gray-900 dark:border-gray-600" required />
                                    <button type="button" wire:click="addJumlah({{ $item->id }})"
                                        class="bg-gray-300 box-border border hover:bg-gray-400 focus:ring-2 font-medium leading-5 hover:text-white dark:bg-gray-900 dark:border-gray-600 text-sm px-3 focus:outline-none h-10">
                                        <svg class="w-4 h-4 text-heading" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 12h14m-7 7V5" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-xs {{ in_array($item->id, $errorStok) ? 'text-red-200' : 'text-red-600' }} {{ $item->produks->stok < $item->jumlah ? 'block' : 'hidden' }}">Jumlah melebihi stok tersisa</p>
                            </td>
                            <td class="px-6 py-4 font-semibold">
                                Rp{{ number_format(($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah) }}
                            </td>
                            <td wire:loading.remove.class="hidden" wire:loading.class="flex"
                                wire:target="addJumlah({{ $item->id }}), kurangJumlah({{ $item->id }}), hapusKeranjang({{ $item->id }})"
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
        <div class="col-span-12 lg:col-span-4 sticky top-24">
            <div class="border border-gray-300 rounded-md p-4 shadow-md relative">
                <div wire:loading.remove.class="hidden" wire:loading.class="flex"
                    wire:target="addJumlah, kurangJumlah, hapusKeranjang"
                    class="absolute z-50 top-0 left-0 right-0 bottom-0 bg-gray-500 hidden justify-center items-center bg-opacity-50">
                    <x-loader />
                </div>
                <h2 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h2>
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span class="font-semibold">
                        Rp {{ number_format($subtotal) }}
                    </span>
                </div>
                @if ($keranjangs->isEmpty())
                    <a href="{{ route('produk') }}"
                        class="w-full block text-center mt-4 bg-yellow-500 hover:bg-yellow-600 text-gray-50 font-semibold py-2 px-4 rounded-md">BELANJA
                        DULU
                    </a>
                @else
                    @if (Auth::check())
                        <button type="button" wire:click="cek" wire:loading.attr="disabled"
                            class="w-full relative block text-center mt-4 bg-yellow-500 hover:bg-yellow-600 text-gray-50 font-semibold py-2 px-4 rounded-md">
                            <span>CHECKOUT SEKARANG</span>
                            <div wire:loading.remove.class="hidden" wire:loading.class="flex" wire:target="cek"
                                class="absolute z-50 top-0 left-0 right-0 bottom-0 bg-gray-500 hidden justify-center items-center bg-opacity-50">
                                <x-loader />
                            </div>
                        </button>
                    @else
                        <button data-modal-target="login" data-modal-toggle="login"
                            class="w-full block text-center mt-4 bg-yellow-500 hover:bg-yellow-600 text-gray-50 font-semibold py-2 px-4 rounded-md">CHECKOUT
                            SEKARANG
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>