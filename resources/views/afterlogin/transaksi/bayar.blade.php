<x-guest-layout title="Pembayaran {{ $trx->kodeTrx }}">
    <section class="reveal">
        <div class="max-w-7xl mx-auto px-6 py-10 md:py-12 text-center">
            <h1 class="text-3xl md:text-4xl font-semibold text-gold tracking-tight">
                PEMBAYARAN
            </h1>
            <P class="text-xs">Selesaikan pembayaran supaya pesanananmu segera diproses</P>
        </div>
    </section>
    <div class="max-w-screen-xl mx-auto rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-8 shadow-2xl">
        <!-- Invoice Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 border-b border-white/10 pb-6">

            <div>
                <p class="text-xs tracking-[0.22em] text-white/60">INVOICE</p>
                <h2 class="text-xl font-semibold mt-1">
                    {{ $trx->kodeTrx ?? $tripay->reference }}
                </h2>
            </div>

            <!-- STATUS -->
            <div>
                @if($tripay->status === 'PAID')
                    <span
                        class="px-4 py-2 rounded-full text-xs font-semibold bg-green-500/20 text-green-400 border border-green-400/30">
                        LUNAS
                    </span>
                @elseif($tripay->status === 'EXPIRED' || \Carbon\Carbon::parse($tripay->expired_time) < now())
                    <span
                        class="px-4 py-2 rounded-full text-xs font-semibold bg-red-500/20 text-red-400 border border-red-400/30">
                        KADALUARSA
                    </span>
                @else
                    <span
                        class="px-4 py-2 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-400 border border-yellow-400/30">
                        MENUNGGU PEMBAYARAN
                    </span>
                @endif
            </div>

        </div>

        <!-- Detail Grid -->
        <div class="grid md:grid-cols-2 gap-8 py-8 border-b border-white/10">
            <!-- Left -->
            <div>
                <p class="text-xs tracking-[0.22em] text-white/60">METODE PEMBAYARAN</p>
                <p class="mt-2 text-lg font-semibold uppercase">
                    {{ $tripay->payment_name == 'QRIS (Customizable)' ? 'QRIS' : $tripay->payment_name }}
                </p>

                <p class="mt-6 text-xs tracking-[0.22em] text-white/60">TOTAL TAGIHAN</p>
                <p class="mt-1 text-3xl font-bold text-[#D4AF37]">
                    Rp {{ number_format($tripay->amount ?? $trx->total, 0, ',', '.') }}
                </p>
            </div>

            <!-- Right -->
            <div>
                <p class="text-xs tracking-[0.22em] text-white/60">BERLAKU SAMPAI</p>
                <p class="mt-2 text-lg font-semibold">
                    {{ \Carbon\Carbon::createFromTimestamp($tripay->expired_time, 'Asia/Jakarta')->isoFormat('DD MMM YYYY - HH:mm') }}
                    WIB
                </p>

                @if($tripay->status === 'UNPAID')
                    <div class="mt-4">
                        <p class="text-xs text-white/60">SISA WAKTU</p>
                        <div id="countdown" class="mt-2 text-lg font-semibold dark:text-white">
                            Loading...
                        </div>
                    </div>
                @endif
            </div>

        </div>

        <!-- Pembayaran -->
        <div class="flex justify-center items-center border-b">
            @if (\Carbon\Carbon::parse($tripay->expired_time) < now() || $tripay->status === 'EXPIRED')
                <div class="py-8 flex flex-col justify-center items-center border-white/10">
                    <p class="text-sm tracking-[0.22em] text-white/60 mb-3">
                        PEMBAYARAN KADALUARSA
                    </p>

                    <p class="text-xs text-center text-white/80">
                        Maaf, waktu pembayaran telah habis. Silakan buat pesanan baru.
                    </p>
                </div>
            @else
                @if($tripay->pay_code || $tripay->pay_url)
                    @if ($tripay->pay_code)
                        <div class="py-8  border-white/10">
                            <p class="text-xs text-center tracking-[0.22em] text-white/60 mb-3">
                                KODE PEMBAYARAN
                            </p>

                            <div
                                class="flex items-center justify-center bg-black/40 border border-white/10 rounded-2xl px-5 py-4 gap-2">
                                <span class="text-lg font-mono tracking-widest">
                                    {{ $tripay->pay_code }}
                                </span>

                                <button onclick="copyToClipboard('{{ $tripay->pay_code }}')"
                                    class="text-xs bg-[#D4AF37] text-black px-4 py-2 rounded-full font-semibold hover:opacity-90">
                                    SALIN
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="py-8  border-white/10">
                            <p class="text-xs text-center tracking-[0.22em] text-white/60 mb-3">
                                PEMBAYARAN VIA APLIKASI
                            </p>
                            <a href="{{ $tripay->pay_url }}"
                                class="inline-block bg-[#D4AF37] text-black font-semibold px-8 py-3 rounded-full hover:opacity-90 transition">
                                Lanjutkan Pembayaran
                            </a>
                        </div>
                    @endif
                @else
                    <div class="py-8 flex flex-col justify-center items-center border-white/10">
                        <p class="text-sm tracking-[0.22em] text-white/60 mb-3">
                            PEMBAYARAN QRIS
                        </p>

                        <div class="flex flex-col  justify-center bg-black/40 border border-white/10 rounded-2xl px-5 py-4">
                            <img src="{{ $tripay->qr_url }}" alt="QRIS Code" class="h-40">
                        </div>
                        <p class="text-xs mt-2">{{ $tripay->qr_string }}</p>
                        <a href="{{ route('downloadQris', $trx->kodeTrx) }}"
                            class="text-md text-center font-bold bg-gold hover:opacity-85 text-gray-900 py-2 px-4 rounded-xl mt-5 transition">Download
                            QRIS</a>
                    </div>
                @endif
            @endif
        </div>

        <!-- Instructions -->
        @if(!empty($tripay->instructions) && (\Carbon\Carbon::parse($tripay->expired_time) > now() && $tripay->status !== 'EXPIRED'))
            <div class="py-8">
                <p class="text-xs tracking-[0.22em] text-white/60 mb-4">
                    PETUNJUK PEMBAYARAN
                </p>

                <div
                    class="bg-black/40 border border-white/10 rounded-2xl p-5 text-sm text-white/80 leading-relaxed space-y-2">
                    @foreach($tripay->instructions as $instruction)
                        <div class="mb-3">
                            <p class="font-bold text-gold mb-1">
                                {{ $instruction['title'] }}
                            </p>
                            <ul class="list-disc list-inside space-y-1 text-white/70">
                                @foreach($instruction['steps'] as $step)
                                    <li>{!! $step !!}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Back -->
    <div class="mt-10 text-center">
        <a href="{{ route('trx.show', $trx->kodeTrx) }}" class="text-sm text-white/60 hover:text-white transition">
            ← Kembali ke Detail
        </a>
    </div>
    <script>
        // expired_time dari controller (dalam detik)
        var expiredTime = {{ \Carbon\Carbon::parse($tripay->expired_time)->timestamp }} * 1000; // ubah ke ms
        var countdownEl = document.getElementById("countdown");

        function updateCountdown() {
            var now = new Date().getTime();
            var distance = expiredTime - now;

            if (distance <= 0) {
                countdownEl.innerHTML = "-";
                clearInterval(timer);
                return;
            }

            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.innerHTML = hours + " Jam, "
                + minutes + " Menit, "
                + seconds + " Detik";
        }

        updateCountdown(); // jalankan pertama kali
        var timer = setInterval(updateCountdown, 1000);

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text);
            alert('Kode berhasil disalin');
        }
    </script>
</x-guest-layout>