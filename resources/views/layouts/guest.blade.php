<!DOCTYPE html>
<html lang="id">

<head>
    @include('layouts.head')
    <title>{{ ucwords($title) }} - {{ \App\Models\TokoSetting::data()->nama_toko ??  config('app.name', 'Laravel') }}</title>
</head>

<body class="max-h-screen font-poppins scroll-style dark" x-data>
    @include('layouts.nav-guest')
    <div
        class="w-full min-h-screen overflow-hidden">
        <main class=" pt-24 sm:pt-18 bg-white text-black dark:bg-black backdrop-blur  dark:text-white relative min-h-[60dvh] pb-5">
            <!-- Background Glow -->
            <div class="fixed inset-0 -z-10">
                <div
                    class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-yellow-600/30 blur-3xl rounded-full">
                </div>
                <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white/10 blur-3xl rounded-full"></div>
            </div>
            @if ($errors->any())
                <div
                    class="container max-w-screen-xl mx-auto rounded bg-red-200 p-2 border border-red-600 dark:bg-red-500/30 dark:backdrop-blur my-2">
                    <p class="font-bold text-md dark:text-white">Error List</p>
                    <ul class="list-disc ms-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600 dark:text-red-500">{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{ $slot }}
        </main>
        @include('layouts.footer-guest')
    </div>
    <div class="fixed end-6 {{ Auth::check() ? 'bottom-[4.5rem]' : 'bottom-6' }} z-[100]">
        <livewire:keranjang.handle />
    </div>
    @include('sweetalert::alert')
</body>

</html>