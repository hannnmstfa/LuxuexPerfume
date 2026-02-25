<x-guest-layout title="Home">
    <section class="max-w-7xl mx-auto px-6 py-20 md:py-24 grid md:grid-cols-2 gap-14 items-center">
        <div>
            <h2 class="text-5xl md:text-6xl font-bold leading-tight ">
                LUXUEXPERFUME
            </h2>

            <p class="mt-6 text-white/70 text-lg">Elegan. Mewah. Berkelas.</p>

            <p class="mt-4 text-[#D4AF37] font-medium tracking-wider">
                #ingatparfumingatluxuex
            </p>

            <div class="mt-10 flex flex-wrap gap-3">
                <a href="{{ route('produk') }}"
                    class="bg-[#D4AF37] text-black px-8 py-3 rounded-full font-semibold tracking-wider hover:opacity-90">
                    JELAJAHI PRODUK
                </a>
            </div>
        </div>

        <!-- Bottle Placeholder -->
        <div class="flex justify-center">
            <div class="relative w-60 h-96">
                <div
                    class="absolute inset-x-6 bottom-0 top-16 bg-gradient-to-b from-white/10 to-black/50 rounded-3xl border border-white/20">
                </div>
                <div class="absolute inset-x-16 top-0 h-20 bg-black border border-[#D4AF37]/40 rounded-xl"></div>
                <div class="absolute inset-x-16 top-40 bg-black/60 border border-white/10 rounded-xl p-4 text-center">
                    <p class="text-xs tracking-widest text-white/60">LUXUEX</p>
                    <p class="text-sm text-[#D4AF37] font-semibold">SIGNATURE</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Alasan Memilih Brand -->
    <section class="border-t border-white/10 py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-2xl font-semibold mb-10">
                Mengapa Memilih <span class="text-[#D4AF37]">LUXUEXPERFUME</span>?
            </h3>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white/5 border border-white/10 rounded-3xl p-7 hover:border-[#D4AF37]/40 transition">
                    <h4 class="text-[#D4AF37] font-semibold mb-2">Tahan Lama</h4>
                    <p class="text-white/70 text-sm">Aroma premium yang awet seharian.</p>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-3xl p-7 hover:border-[#D4AF37]/40 transition">
                    <h4 class="text-[#D4AF37] font-semibold mb-2">Wangi Eksklusif</h4>
                    <p class="text-white/70 text-sm">Racikan unik, berkelas, tidak pasaran.</p>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-3xl p-7 hover:border-[#D4AF37]/40 transition">
                    <h4 class="text-[#D4AF37] font-semibold mb-2">Kesan Mewah</h4>
                    <p class="text-white/70 text-sm">Tampilan & karakter wangi terasa luxury.</p>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>