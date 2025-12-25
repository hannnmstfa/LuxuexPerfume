<div class="w-full mx-auto relative">
    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
        </svg>
    </div>
    <input type="text" wire:model.live="search"
        class="peer block w-full p-3 ps-9 bg-neutral-secondary-medium border text-heading text-sm rounded-xl  shadow-xs placeholder:text-body"
        placeholder="Cari Produk" autocomplete="off" />
    <div class="absolute {{ $search > 0 ? 'block' : 'hidden' }} peer-focus:block top-12 w-full border bg-gray-100 border-gray-300 rounded-md shadow-lg z-[100]"
        id="search-results">
        <ul class="bg-white shadow rounded w-full max-h-56 overflow-y-auto">
            @if (strlen($search) < 1)
                <li class="p-2 text-gray-500 text-xs text-center">Ketik untuk memulai mencari</li>
            @else
                @forelse($searchResults as $produk)
                    <li class="p-2 hover:bg-gray-100">
                        <a href="{{ route('produk.detail', $produk->slug) }}" class="flex items-center gap-2">
                            <img src="{{ asset($produk->path_foto) }}" alt="{{ $produk->nama }}"
                                class="w-10 h-10 object-cover rounded" />
                                <div>
                                    <p class="text-sm text-heading line-clamp-1">{{ $produk->nama }}</p>
                                    <p class="text-xs text-gray-500">Rp {{ number_format($produk->harga_diskon ? $produk->harga_diskon : $produk->harga) }}</p>
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