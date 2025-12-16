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
                    <a href="#" class="bg-white rounded-lg shadow-md overflow-hidden relative group !z-0">
                        <div class="relative z-[5]">
                            <span
                                class="absolute top-0  right-0 {{ $product->kategori == 'pria' ? 'bg-gray-800' : 'bg-pink-500' }} text-white text-xs font-semibold px-2 py-1 rounded">
                                {{ ucfirst($product->kategori) }}
                            </span>
                        </div>
                        <div class="relative">
                            <img src="{{ asset($product->path_foto) }}" loading="lazy" alt="{{ $product->nama }}"
                            class="w-full h-48 group-hover:scale-105 transition-transform duration-300 object-cover">
                            <span class="absolute bottom-0 left-0 bg-gray-500 text-white text-xs font-semibold px-2 py-1 rounded-r">
                                Stok Tersisa: {{ $product->stocks->jumlah ?? 0 }}
                            </span>
                        </div>
                        <div class="px-4">
                            <h3 class="text-lg font-semibold mb-2 line-clamp-1">{{ $product->nama }}</h3>
                            <p class="text-xs text-red-500 italic line-through {{ $product->harga_diskon !== null ? '' : 'hidden' }}">Rp {{ number_format($product->harga) }}</p>
                            <p class="text-gray-700 font-bold text-xl">Rp {{ number_format($product->harga_diskon == null ? $product->harga : $product->harga_diskon) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>