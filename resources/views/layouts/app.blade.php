<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        @include('layouts.head')
        <title>{{ ucwords($title) }} - Admin {{ config('app.name', 'Laravel') }}</title>
    </head>
<body class="font-poppins antialiased bg-gray-50">
    <div class="max-h-screen">
        @include('layouts.sidebar-adm')
        @include('layouts.adm-nav')
        <!-- Page Content -->
        <main class="p-4 sm:ml-64 pt-20 sm:pt-18 min-h-screen dark:bg-gray-700 dark:text-white">
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
    @livewireScript
</body>
</html>