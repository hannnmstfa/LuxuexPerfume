<div class="relative">
    <form class="relative">
        <input wire:model.live="search" type="text" placeholder="Cari parfum..." class="w-64 rounded-full bg-white/5 border border-white/10 px-4 py-2 text-sm text-white placeholder:text-white/40 focus:ring-2 focus:ring-[#D4AF37]/40" />
        <button type="button"
            class="absolute right-1 top-1/2 -translate-y-1/2 rounded-full bg-[#D4AF37] px-3 py-1.5 text-xs font-semibold text-black hover:opacity-90">
            CARI
        </button>
    </form>
    <div class="absolute {{ $search > 0 ? 'block' : 'hidden' }} peer-focus:block top-12 w-full border  border-gray-300 rounded shadow-lg z-20"
        id="search-results">
        <ul class="bg-black/90 backdrop-blur shadow rounded w-full max-h-56 overflow-y-auto">
            @if (strlen($search) < 1)
                <li class="p-2 text-gray-500 text-xs text-center">Ketik untuk memulai mencari</li>
            @else
                @forelse($searchResults as $produk)
                    <li class="p-2 hover:bg-gray-800">
                        <a href="{{ route('produk.detail', $produk->slug) }}" class="flex items-center gap-2">
                            <img src="{{ asset($produk->path_foto) }}" alt="{{ $produk->nama }}"
                                class="w-10 h-10 object-cover rounded" />
                            <div>
                                <p class="text-sm text-heading line-clamp-1">{{ $produk->nama }}</p>
                                <p class="text-xs text-gray-500">Rp
                                    {{ number_format($produk->harga_diskon ? $produk->harga_diskon : $produk->harga) }}
                                </p>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="p-2 text-gray-500 text-sm text-center">Produk tidak ditemukan</li>
                @endforelse
            @endif
        </ul>

    </div>
</div>