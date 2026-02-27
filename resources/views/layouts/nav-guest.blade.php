<header x-data="{ open:false }" class="sticky w-full top-0 z-50 border-b border-white/10 bg-black/70 backdrop-blur">
    <div class="max-w-screen-xl mx-auto px-6 py-4 flex items-center justify-between gap-4">
        <!-- Brand -->
        <a href="{{ route('/') }}" class="flex items-center gap-3">
            <img src="{{ asset('assets/logo.jpg') }}" class="size-9 rounded-full border border-gold" alt="Logo">
            <span class="text-sm md:text-base tracking-[0.28em] font-semibold text-[#D4AF37]">
                LUXUEXPERFUME
            </span>
        </a>
        <div class="flex items-center gap-4">
            <nav class="hidden md:flex items-center gap-8 text-xs tracking-[0.22em] text-white/80">
                <a href="{{ route('/') }}" class="hover:text-white">HOME</a>
                <a href="{{ route('produk') }}" class="hover:text-white">PRODUK</a>
            </nav>
            <div class="hidden md:flex items-center gap-3">
                <livewire:produk.search/>
                @guest
                    <a href="{{ route('login') }}"
                        class="rounded-full border border-white/15 bg-white/5 px-5 py-2 text-xs tracking-[0.18em] text-white/85 hover:bg-white/10">
                        LOGIN
                    </a>
                @else
                    <!-- Avatar + Dropdown -->
                    <div x-data="{ userOpen:false }" class="relative" @click.away="userOpen=false">
                        <button type="button" @click="userOpen=!userOpen"
                            class="flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-3 py-2 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]/40">

                            <img class="w-8 h-8 rounded-full" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"
                                alt="user photo">

                            <span class="hidden lg:inline text-xs tracking-[0.18em] text-white/80">
                                {{ Str::of(Auth::user()->name)->before(' ') }}
                            </span>
                        </button>

                        <div x-show="userOpen" x-transition x-cloak
                            class="absolute right-0 mt-3 w-52 overflow-hidden rounded-2xl border border-white/10 bg-black/90 shadow-2xl shadow-black/50">

                            <div class="px-4 py-3 border-b border-white/10">
                                <div class="text-sm font-semibold text-white">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-white/60 truncate">{{ Auth::user()->email }}</div>
                            </div>

                            <div class="p-2 text-sm">
                                <a href="{{ route('profile') }}"
                                    class="block rounded-xl px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white">
                                    Profile
                                </a>

                                <a href="{{ route('trx.index') }}"
                                    class="block rounded-xl px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white">
                                    Transaksi
                                </a>

                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="block rounded-xl px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white">
                                        Admin Panel
                                    </a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left rounded-xl px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
        <button @click="open = !open" x-cloak
            class="md:hidden inline-flex items-center justify-center rounded-full border border-white/15 bg-white/5 p-2 hover:bg-white/10"
            aria-label="Toggle menu">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div x-show="open" x-transition x-cloak class="md:hidden border-t border-white/10 bg-black/80 backdrop-blur-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 space-y-6">
            <nav class="flex flex-col gap-3 text-xs tracking-[0.22em] text-white/85">
                <a href="{{ route('/') }}"
                    class="rounded-xl border border-white/10 bg-white/5 px-4 py-3 hover:bg-white/10">HOME</a>
                <a href="{{ route('produk') }}"
                    class="rounded-xl border border-white/10 bg-white/5 px-4 py-3 hover:bg-white/10">PRODUK</a>
            </nav>
            <form action="#" method="GET" class="grid gap-3">
                <input name="q" type="text" placeholder="Cari parfum..."
                    class="w-full rounded-xl bg-white/5 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]/40" />
                <button type="submit"
                    class="w-full rounded-xl bg-[#D4AF37] px-4 py-3 text-sm font-semibold text-black hover:opacity-90">CARI</button>
            </form>
            @guest
                <div class="w-full flex justify-center items-center">
                    <a href="{{ route('login') }}"
                        class="w-full mt-2 rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-xs tracking-[0.18em] text-white/85 font-semibold text-center hover:bg-white/10 transition">
                        LOGIN
                    </a>
                </div>
            @else
                <div x-data="{ userOpen:false }" class="relative">
                    <button type="button" @click="userOpen=!userOpen"
                        class="flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-3 py-2 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-[#D4AF37]/40 w-full">
                        <img class="w-8 h-8 rounded-full" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"
                            alt="user photo">
                            <div class="flex flex-col items-start">
                                <div class="text-sm font-semibold text-white">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-white/60 truncate">{{ Auth::user()->email }}</div>
                            </div>
                        </button>
                    <div x-show="userOpen" x-transition x-cloak
                        class="mt-3 w-full overflow-hidden rounded-2xl border border-white/10 bg-black/90 shadow-2xl shadow-black/50">
                        <div class="p-2 text-sm flex flex-col gap-1">
                            <a href="{{ route('profile') }}"
                                class="block rounded-xl px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white">Profile</a>
                            <a href="{{ route('trx.index') }}"
                                class="block rounded-xl px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white">Transaksi</a>
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block rounded-xl px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white">Admin
                                    Panel</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left rounded-xl px-3 py-2 text-white/80 hover:bg-white/10 hover:text-white">Sign
                                    out</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</header>