<footer class="sticky bottom-0 dark:bg-black dark:text-white border-t border-white/10 w-full">
    <!-- Glow -->
    <div class="absolute inset-0 -z-10 pointer-events-none">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-yellow-600/10 blur-3xl rounded-full">
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid md:grid-cols-3 gap-12">
            <!-- Brand -->
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <img src="{{ asset(\App\Models\TokoSetting::data()->path_logo ?? '') }}" class="size-9 rounded-full border border-gold" alt="Logo">
                    <span class="text-lg tracking-[0.28em] font-semibold text-[#D4AF37] uppercase">
                        {{ \App\Models\TokoSetting::data()->nama_toko ??  config('app.name', 'Laravel') }}
                    </span>
                </div>

                <p class="text-sm text-white/60 leading-relaxed">
                    Parfum premium dengan karakter elegan dan mewah.
                    Setiap aroma dirancang untuk meninggalkan kesan tak terlupakan.
                </p>

                <p class="mt-4 text-xs tracking-[0.22em] text-white/50">
                    #ingatparfumingatluxuex
                </p>
            </div>

            <!-- Customer Service -->
            <div>
                <h3 class="text-sm tracking-[0.22em] text-[#D4AF37] font-semibold mb-6">
                    CUSTOMER SERVICE
                </h3>

                <div class="space-y-4 text-sm text-white/70">

                    <div>
                        <p class="text-white/50 text-xs">Asisten Chat</p>
                        <button class="hover:text-white transition">
                            24 Jam Online Assistant
                        </button>
                    </div>

                    <!-- <div>
                        <p class="text-white/50 text-xs">Email</p>
                        <a href="mailto:cs@luxuexperfume.com" class="hover:text-white transition">
                            cs@luxuexperfume.com
                        </a>
                    </div> -->

                    <div>
                        <p class="text-white/50 text-xs">Jam Operasional</p>
                        <p>Senin – Sabtu, 09.00 – 21.00 WIB</p>
                    </div>

                </div>
            </div>

            <!-- Legal -->
            <div>
                <h3 class="text-sm tracking-[0.22em] text-[#D4AF37] font-semibold mb-6">
                    INFORMASI
                </h3>

                <div class="space-y-4 text-sm text-white/70">

                    <a href="{{ route('ketentuan.layanan') }}" class="block hover:text-white transition">
                        Ketentuan Layanan
                    </a>

                    <a href="{{ route('kebijakan.privasi') }}" class="block hover:text-white transition">
                        Kebijakan Privasi
                    </a>

                    <!-- <a href="" class="block hover:text-white transition">
                        Kebijakan Pengembalian
                    </a> -->

                </div>
            </div>

        </div>

        <!-- Divider -->
        <div
            class="mt-14 border-t border-white/10 pt-6 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-white/50">

            <p>
                © {{ date('Y') }} LUXUEXPERFUME. All rights reserved.
            </p>

            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-white transition">Instagram</a>
                <a href="#" class="hover:text-white transition">TikTok</a>
                <a href="#" class="hover:text-white transition">Facebook</a>
            </div>

        </div>

    </div>
</footer>