<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', __('Error'))</title>
    @include('layouts.head')
</head>

<body class="min-h-screen bg-black text-white relative overflow-hidden">
    <div
        class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(212,175,55,0.18),transparent_30%),radial-gradient(circle_at_bottom_left,rgba(255,255,255,0.08),transparent_25%)]">
    </div>

    <div
        class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-yellow-600 to-transparent opacity-70">
    </div>
    <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/30 to-transparent">
    </div>

    <main class="relative z-10 min-h-screen flex items-center justify-center px-6 py-12">
        <section class="w-full max-w-6xl grid lg:grid-cols-2 gap-10 items-center">
            <div class="space-y-6">
                <div
                    class="inline-flex items-center gap-3 px-4 py-2 rounded-full border border-yellow-600/40 bg-white/5 backdrop-blur-sm">
                    <span class="h-2 w-2 rounded-full bg-yellow-500 animate-pulse"></span>
                    <span class="text-sm tracking-[0.25em] uppercase text-yellow-400">System Notice</span>
                </div>

                <div class="space-y-4">
                    <h1 class="text-6xl md:text-8xl font-black tracking-tight leading-none">
                        @yield('code', $exception->getStatusCode() ?? 'Error')
                    </h1>
                    <div class="h-1 w-28 bg-gradient-to-r from-yellow-500 to-white rounded-full"></div>
                    <h2 class="text-2xl md:text-4xl font-semibold leading-tight max-w-xl">
                        @yield('message', __('Terjadi kesalahan pada sistem.'))
                    </h2>
                    @php($code = trim($__env->yieldContent('code', $exception->getStatusCode() ?? '')))

                    @if ($code !== '503')
                        <p class="text-white/70 text-base md:text-lg max-w-xl leading-relaxed">
                            @hasSection('description')
                                @yield('description')
                            @else
                                Halaman yang kamu tuju tidak ditemukan atau sedang tidak bisa diakses. Silakan kembali ke beranda atau coba lagi
                                beberapa saat lagi.
                            @endif
                        </p>
                    @endif
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    @php($code = trim($__env->yieldContent('code', $exception->getStatusCode() ?? '')))

                    @if ($code !== '503')
                        <a href="{{ url('/') }}"
                            class="px-6 py-3 rounded-2xl bg-yellow-500 text-black font-semibold hover:scale-[1.02] transition-transform shadow-[0_0_30px_rgba(234,179,8,0.25)] text-center">
                            Kembali ke Beranda
                        </a>
                    @endif
                </div>
            </div>

            <div class="relative flex items-center justify-center">
                <div class="absolute h-72 w-72 md:h-96 md:w-96 rounded-full border border-yellow-500/20 animate-pulse">
                </div>
                <div class="absolute h-56 w-56 md:h-80 md:w-80 rounded-full border border-white/10"></div>

                <div
                    class="relative w-full max-w-md rounded-[2rem] border border-yellow-600/25 bg-white/5 backdrop-blur-xl shadow-2xl p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <p class="text-xs uppercase tracking-[0.35em] text-yellow-400">Error State</p>
                            <p class="text-white/60 text-sm mt-2">@yield('title', __('Access Exception'))</p>
                        </div>
                        <div
                            class="h-14 w-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-yellow-700 flex items-center justify-center text-black font-black text-xl shadow-lg">
                            !
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div class="rounded-2xl border border-white/10 p-4 bg-white/5">
                                <p class="text-xs uppercase tracking-[0.2em] text-white/40">Server Status</p>
                                <p class="mt-2 text-white font-medium">Online</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 p-4 bg-white/5">
                                <p class="text-xs uppercase tracking-[0.2em] text-white/40">Security</p>
                                <p class="mt-2 text-yellow-400 font-medium">Protected</p>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-black/30 p-4">
                            <p class="text-sm text-white/50 mb-2">Timestamp</p>
                            <p class="text-white font-medium">
                                <span id="date"></span> <span id="time"></span> <span id="span">WIB</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script>
    function updateTime() {
        const now = new Date();

        // JAM
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;

        // HARI & TANGGAL (Indonesia)
        const days = [
            'Minggu', 'Senin', 'Selasa', 'Rabu',
            'Kamis', 'Jumat', 'Sabtu'
        ];

        const months = [
            'Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        ];

        const dayName = days[now.getDay()];
        const date = now.getDate();
        const monthName = months[now.getMonth()];
        const year = now.getFullYear();

        const fullDate = `${dayName}, ${date} ${monthName} ${year}`;

        // OUTPUT
        document.getElementById('time').textContent = timeString;
        document.getElementById('date').textContent = fullDate;
        document.getElementById('span').textContent = 'WIB';
    }

    setInterval(updateTime, 1000);
    updateTime();
</script>

</html>