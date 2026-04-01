<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    <title>{{ ucwords($title) }} - Admin {{ \App\Models\TokoSetting::data()->nama_toko ??  config('app.name', 'Laravel') }}</title>
</head>

<body class="max-h-screen font-poppins scroll-style dark" x-data>
    <div class="bg-white text-black dark:bg-black dark:text-white">
        <div class="fixed inset-0 -z-5">
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-yellow-600/30 blur-3xl rounded-full">
            </div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-white/10 blur-3xl rounded-full"></div>
        </div>
        @include('layouts.sidebar-adm')
        @include('layouts.adm-nav')
        <!-- Page Content -->
        <main class="p-4 sm:ml-64 pt-20 sm:pt-18 min-h-screen">
            @if ($errors->any())
                <div class="container rounded bg-red-200 p-2 border border-red-600 mb-2">
                    <p class="font-bold text-md dark:text-black">Error List</p>
                    <ul class="list-disc ms-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600">{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{ $slot }}
        </main>
    </div>
    @include('sweetalert::alert')
</body>

</html>