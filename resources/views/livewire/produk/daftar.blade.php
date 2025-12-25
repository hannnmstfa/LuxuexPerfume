<div class="max-w-screen-xl mx-auto">
    <div class="md:grid grid-cols-4 gap-2 space-y-2">
        <div
            class="col-span-1 sticky top-20 !z-20 px-4 bg-white/20 backdrop-blur-xl backdrop-saturate-150 border-b md:border-none shadow md:shadow-none">
            <div id="accordion-flush" class=" md:sticky md:top-20" data-accordion="collapsed"
                data-active-classes="text-heading" data-inactive-classes="text-body" aria-expanded="true">
                <h2 id="heading-filter">
                    <button type="button" class="flex items-center justify-between w-full pt-3 pb-2 font-medium gap-3"
                        data-accordion-target="#filter" aria-controls="filter">
                        <div class="flex justify-start items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z" />
                            </svg>
                            <span>FILTER</span>
                        </div>
                        <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0 md:hidden" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m5 15 7-7 7 7" />
                        </svg>
                    </button>
                </h2>
                <div id="filter" class="hidden md:block ps-6 pb-3" aria-labelledby="heading-filter">
                    <div class="mb-2">
                        <p class="text-sm text-gray-400 font-semibold">KATEGORI</p>
                        <div>
                            <input type="radio" wire:click="$set('kategori', 'all')" name="kategori" value="all"
                                id="kategori_all" class="me-1 w-3 h-3" checked>
                            <label for="kategori_all" class="text-sm">Semua Kategori</label>
                        </div>
                        <div>
                            <input type="radio" wire:click="$set('kategori', 'pria')" name="kategori" value="pria"
                                id="kategori_pria" class="me-1 w-3 h-3">
                            <label for="kategori_pria" class="text-sm">Pria</label>
                        </div>
                        <div>
                            <input type="radio" wire:click="$set('kategori', 'wanita')" name="kategori" value="wanita"
                                id="kategori_wanita" class="me-1 w-3 h-3">
                            <label for="kategori_wanita" class="text-sm">Wanita</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <p class="text-sm text-gray-400 font-semibold">URUTAN</p>
                        <div>
                            <input type="radio" name="sort" wire:click="sort('nama', 'asc')" id="sort_asc"
                                class="me-1 w-3 h-3" checked>
                            <label for="sort_asc" class="text-sm">A-Z</label>
                        </div>

                        <div>
                            <input type="radio" name="sort" wire:click="sort('nama', 'desc')" id="sort_desc"
                                class="me-1 w-3 h-3">
                            <label for="sort_desc" class="text-sm">Z-A</label>
                        </div>
                        <div>
                            <input type="radio" name="sort" wire:click="sort('harga', 'asc')" id="sort_harga_asc"
                                class="me-1 w-3 h-3">
                            <label for="sort_harga_asc" class="text-sm">Harga Terendah</label>
                        </div>

                        <div>
                            <input type="radio" name="sort" wire:click="sort('harga', 'desc')" id="sort_harga_desc"
                                class="me-1 w-3 h-3">
                            <label for="sort_harga_desc" class="text-sm">Harga Tertinggi</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-3 px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($products as $i => $product)
                    <div class="bg-white font-inter  shadow-md overflow-hidden relative group !z-0">
                        <div class="relative z-[5]">
                            <span
                                class="absolute top-0  right-0 {{ $product->kategori == 'pria' ? 'bg-gray-800' : 'bg-pink-500' }} text-white text-xs font-semibold px-2 py-1 rounded">
                                {{ ucfirst($product->kategori) }}
                            </span>
                        </div>
                        <div class="relative">
                            <img src="{{ asset($product->path_foto) }}" loading="lazy" alt="{{ $product->nama }}"
                                class="w-full h-48 hover:scale-105 transition-transform duration-300 object-cover">
                            <span
                                class="absolute bottom-0 left-0 bg-gray-500 text-white text-xs font-semibold px-2 py-1 rounded-r">
                                Stok Tersisa: {{ $product->stocks->jumlah ?? 0 }}
                            </span>
                        </div>
                        <div class="px-4 pb-3">
                            <h3 class="text-lg font-semibold mb-2 line-clamp-1">{{ $product->nama }}</h3>
                            <p
                                class="text-xs text-red-500 italic line-through {{ $product->harga_diskon !== null ? '' : 'hidden' }}">
                                Rp {{ number_format($product->harga) }}</p>
                            <p class="text-gray-500 font-semibold text-xl">Rp
                                {{ number_format($product->harga_diskon == null ? $product->harga : $product->harga_diskon) }}
                            </p>
                        </div>
                        <div
                            class="md:absolute bottom-0 p-2 md:p-0 font-inter md:hidden md:group-hover:grid md:animate-swipeUp grid-cols-4 mb-3 md:mb-0 bg-gray-50 left-0 w-full justify-center items-center space-y-1 md:space-y-0 gap-[2px]">
                            <button wire:click="$dispatch('addKeranjang', { productId: {{ $product->id }}})"
                                class="col-span-1 w-full md:col-span-3 flex justify-center items-center text-xs border border-yellow-600 hover:bg-yellow-600 text-yellow-600 hover:text-white font-bold py-2 px-4 shadow-md transition-colors duration-100">
                                @if(isset($this->success[$product->id]))
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                    </svg>
                                    <span class="ms-1">Ditambahkan</span>
                                @else
                                    <svg class="w-5 h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                    </svg>
                                    <span class="ms-1">Tambah ke Keranjang</span>
                                @endif
                            </button>
                            <div class="col-span-1">
                                <a href="{{ route('produk.detail', $product->slug) }}" data-tooltip-target="tooltiptest{{ $i }}"
                                    class="w-full flex gap-1 justify-center items-center text-xs bg-gray-500 hover:bg-gray-700 border border-gray-500 text-white font-semibold py-2 px-4 shadow-md transition-colors duration-300">
                                    <span class="block md:hidden">Detail Produk</span>
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                </a>
                                <div id="tooltiptest{{ $i }}" role="tooltip"
                                    class="absolute !z-[100] inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-base shadow-xs opacity-0 tooltip">
                                    Lihat detail produk
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>