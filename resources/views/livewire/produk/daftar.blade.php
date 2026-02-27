<div class="max-w-screen-xl mx-auto">
    <div class="md:grid grid-cols-4 gap-6 space-y-6 md:space-y-0 py-2">
        {{-- SIDEBAR FILTER --}}
        <div class="col-span-1">
            <div
                class="sticky top-20 z-20 rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl backdrop-saturate-150">
                <div id="accordion-flush" class="md:sticky md:top-20" data-accordion="collapsed"
                    data-active-classes="text-white" data-inactive-classes="text-white/70" aria-expanded="true">

                    <h2 id="heading-filter">
                        <button type="button"
                            class="flex items-center justify-between w-full px-5 pt-5 pb-4 font-semibold gap-3"
                            data-accordion-target="#filter" aria-controls="filter">
                            <div class="flex justify-start items-center gap-2">
                                <svg class="w-5 h-5 text-[#D4AF37]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z" />
                                </svg>
                                <span class="text-sm tracking-[0.22em] text-white/80">FILTER</span>
                            </div>
                            <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0 md:hidden text-white/70"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m5 15 7-7 7 7" />
                            </svg>
                        </button>
                    </h2>

                    <div id="filter" class="hidden md:block px-5 pb-5" aria-labelledby="heading-filter">
                        <div class="h-px bg-white/10 mb-5"></div>

                        <div class="mb-6">
                            <p class="text-xs tracking-[0.22em] text-white/60 font-semibold">KATEGORI</p>

                            <div class="mt-3 space-y-2 text-sm text-white/80">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" wire:click="$set('kategori', 'all')" name="kategori" value="all"
                                        id="kategori_all" class="w-4 h-4 accent-[#D4AF37]" checked>
                                    <span>Semua</span>
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" wire:click="$set('kategori', 'pria')" name="kategori"
                                        value="pria" id="kategori_pria" class="w-4 h-4 accent-[#D4AF37]">
                                    <span>Pria</span>
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" wire:click="$set('kategori', 'wanita')" name="kategori"
                                        value="wanita" id="kategori_wanita" class="w-4 h-4 accent-[#D4AF37]">
                                    <span>Wanita</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-2">
                            <p class="text-xs tracking-[0.22em] text-white/60 font-semibold">URUTAN</p>

                            <div class="mt-3 space-y-2 text-sm text-white/80">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="sort" wire:click="sort('nama', 'asc')" id="sort_asc"
                                        class="w-4 h-4 accent-[#D4AF37]" checked>
                                    <span>A–Z</span>
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="sort" wire:click="sort('nama', 'desc')" id="sort_desc"
                                        class="w-4 h-4 accent-[#D4AF37]">
                                    <span>Z–A</span>
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="sort" wire:click="sort('harga', 'asc')"
                                        id="sort_harga_asc" class="w-4 h-4 accent-[#D4AF37]">
                                    <span>Harga Terendah</span>
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="sort" wire:click="sort('harga', 'desc')"
                                        id="sort_harga_desc" class="w-4 h-4 accent-[#D4AF37]">
                                    <span>Harga Tertinggi</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PRODUCT GRID --}}
        <div class="col-span-3" x-data="{
            showImg: false, imgSrc: '',
            showDetail: false, detail: {},
            openDetail(product) {
                this.detail = product;
                this.showDetail = true;
            }
        }">
            <div class="reveal grid grid-cols-1 md:grid-cols-3 gap-6 relative">
                <div wire:loading.remove.class="hidden" wire:loading.class="flex"
                    class="absolute w-full z-50 rounded-xl top-0 left-0 right-0 bottom-0 bg-black/80 backdrop-blur hidden justify-center items-center bg-opacity-50">
                    <x-loader />
                </div>
                @foreach ($products as $i => $product)
                    <div
                        class="reveal group rounded-3xl border border-white/10 bg-white/5 overflow-hidden relative hover:border-[#D4AF37]/35 transition">
                        <!-- Badge kategori -->
                        <div class="absolute top-3 right-3 z-10">
                            <span
                                class="rounded-full px-3 py-1 text-[11px] font-semibold {{ $product->kategori == 'pria' ? 'bg-gold border border-white/15 text-black' : 'bg-pink-400 text-black' }}">
                                {{ ucfirst($product->kategori) }}
                            </span>
                        </div>
                        <!-- Image -->
                        <div class="relative cursor-pointer"
                            @click="showImg = true; imgSrc = '{{ asset($product->path_foto) }}'">
                            <img src="{{ asset($product->path_foto) }}" loading="lazy" alt="{{ $product->nama }}"
                                class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-105">
                            <span
                                class="absolute bottom-3 left-3 rounded-full px-3 py-1 text-[11px] font-semibold {{ $product->stok < 1 ? 'bg-red-500/90 text-white' : 'bg-black/50 border border-white/10 text-white/90' }}">
                                {{ $product->stok < 1 ? 'Stok Habis' : 'Stok: ' . $product->stok }}
                            </span>
                        </div>
                        <!-- Content -->
                        <div class="px-5 pt-4 pb-5">
                            <h3 class="text-base font-semibold mb-2 line-clamp-1">{{ $product->nama }}</h3>
                            <p
                                class="text-xs text-red-400 line-through {{ $product->harga_diskon !== null ? '' : 'hidden' }}">
                                Rp {{ number_format($product->harga) }}</p>
                            <p class="text-[#D4AF37] font-semibold text-xl">Rp
                                {{ number_format($product->harga_diskon == null ? $product->harga : $product->harga_diskon) }}
                            </p>
                            <!-- Desktop hover action bar (swipe up) -->
                            <div
                                class="hidden md:grid opacity-0 group-hover:opacity-100 translate-y-3 group-hover:translate-y-0 transition-all duration-300 mt-5 grid-cols-4 gap-2">
                                <button wire:click="$dispatch('addKeranjang', { productId: {{ $product->id }} })"
                                    class="col-span-3 w-full flex justify-center items-center text-xs rounded-full border border-[#D4AF37] bg-[#D4AF37] text-black font-bold py-2 px-4 hover:opacity-90">
                                    @if(isset($this->success[$product->id]))
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                        </svg><span class="ms-1">Ditambahkan</span>
                                    @else
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg><span class="ms-1">Tambah</span>
                                    @endif
                                </button>
                                <button @click="openDetail({
                                                    id: {{ $product->id }},
                                                    nama: @js($product->nama),
                                                    deskripsi: @js($product->deskripsi),
                                                    harga: '{{ number_format($product->harga, 0, ',', '.') }}',
                                                    harga_diskon: {{ $product->harga_diskon ? ('\'' . number_format($product->harga_diskon, 0, ',', '.') . '\'') : 'null' }},
                                                    stok: {{ $product->stok }},
                                                    path_foto: '{{ asset($product->path_foto) }}'
                                                })"
                                    class="col-span-1 w-full grid place-items-center rounded-full border border-white/15 bg-white/5 text-white/85 hover:bg-white/10">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                            d="m21 21-3.5-3.5M10 7v6m-3-3h6m4 0a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Mobile action bar (always visible, luxury style) -->
                            <div class="md:hidden mt-5 grid grid-cols-4 gap-2">
                                <button wire:click="$dispatch('addKeranjang', { productId: {{ $product->id }} })"
                                    class="col-span-3 w-full flex justify-center items-center text-xs rounded-2xl border border-[#D4AF37] bg-[#D4AF37] text-black font-bold py-3 px-4 hover:opacity-90">
                                    @if(isset($this->success[$product->id]))
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                        </svg><span class="ms-1">Ditambahkan</span>
                                    @else
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg><span class="ms-1">Tambah</span>
                                    @endif
                                </button>
                                <button @click="openDetail({
                                                    id: {{ $product->id }},
                                                    nama: @js($product->nama),
                                                    deskripsi: @js($product->deskripsi),
                                                    harga: '{{ number_format($product->harga, 0, ',', '.') }}',
                                                    harga_diskon: {{ $product->harga_diskon ? ('\'' . number_format($product->harga_diskon, 0, ',', '.') . '\'') : 'null' }},
                                                    stok: {{ $product->stok }},
                                                    path_foto: '{{ asset($product->path_foto) }}'
                                                })"
                                    class="col-span-1 w-full flex justify-center items-center text-xs rounded-2xl border border-white/15 bg-white/5 text-white/85 hover:bg-white/10">
                                    <span class="sr-only">Detail</span>
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Image Modal -->
            <div x-show="showImg" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/80"
                style="display: none;">
                <div class="absolute inset-0" @click="showImg = false"></div>
                <img :src="imgSrc" class="max-h-[80vh] max-w-[90vw] rounded-2xl shadow-2xl border-4 border-white"
                    alt="Preview" />
                <button @click="showImg = false"
                    class="absolute top-6 right-6 text-white bg-black/60 rounded-full p-2 hover:bg-black/80">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Product Detail Modal -->
            <div x-show="showDetail" x-transition
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/80" style="display: none;">
                <div class="absolute inset-0" @click="showDetail = false"></div>
                <div
                    class="relative bg-black/10 backdrop-blur border border-gray-300 rounded-xl shadow-sm p-4 md:p-6 max-w-screen-xl w-full mx-4 overflow-auto">
                    <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                        <h3 class="text-lg font-bold text-gold">Rincian Produk</h3>
                        <button type="button" @click="showDetail = false"
                            class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="space-y-4 md:space-y-6 py-4 md:py-6 overflow-auto">
                        <div class="rounded-lg p-6 flex flex-col md:flex-row gap-6">
                            <div class="md:w-1/2 flex justify-center items-center">
                                <img :src="detail.path_foto" :alt="detail.nama"
                                    class="size-72 h-auto rounded-lg shadow-lg">
                            </div>
                            <div class="md:w-1/2 flex flex-col justify-between" x-data="{ addedToCart: false }"
                                x-init="$watch('showDetail', v => { if(!v) addedToCart = false })">
                                <div>
                                    <h1 class="text-3xl font-bold mb-4" x-text="detail.nama"></h1>
                                    <p class="text-gray-300 mb-4" x-text="detail.deskripsi"></p>
                                    <template x-if="detail.harga_diskon && detail.harga_diskon !== 'null'">
                                        <p class="text-xs font-semibold text-gray-400 mb-2 line-through">Rp <span
                                                x-text="detail.harga"></span></p>
                                    </template>
                                    <p class="text-2xl font-bold text-yellow-400 mb-4">Rp <span
                                            x-text="detail.harga_diskon && detail.harga_diskon !== 'null' ? detail.harga_diskon : detail.harga"></span>
                                    </p>
                                    <p class="text-gray-400">
                                        <span
                                            :class="detail.stok < 1 ? 'text-red-600 border p-1 rounded bg-red-100 border-red-400' : ''"
                                            class="font-semibold"
                                            x-text="detail.stok < 1 ? 'Stok Habis' : 'Stok tersisa: ' + detail.stok"></span>
                                    </p>
                                </div>
                                <div class="mt-6">
                                    <template x-if="!addedToCart">
                                        <button
                                            @click="$dispatch('addKeranjang', { productId: detail.id }); addedToCart = true"
                                            class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                                            Tambah ke Keranjang
                                        </button>
                                    </template>
                                    <template x-if="addedToCart">
                                        <button disabled
                                            class="w-full bg-yellow-500 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 11.917 9.724 16.5 19 7.5" />
                                            </svg>
                                            Ditambahkan
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reveal mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>