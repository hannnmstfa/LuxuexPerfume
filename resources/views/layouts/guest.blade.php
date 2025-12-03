<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
        <title>{{ ucwords($title) }} - {{ config('app.name', 'Laravel') }}</title>
    </head>
    <body class="font-poppins antialiased">
        <div class="max-h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            @include('layouts.nav-guest')
            <main class=" bg-gray-50 min-h-screen pt-20">
                {{ $slot }}
            </main>
        </div>
        @include('sweetalert::alert')
    </body>
</html>
