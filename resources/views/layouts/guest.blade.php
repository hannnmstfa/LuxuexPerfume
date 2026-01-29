<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    <title>{{ ucwords($title) }} - {{ config('app.name', 'Laravel') }}</title>
</head>

<body class="font-poppins antialiased relative">
    <div class="max-h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        @include('layouts.nav-guest')
        <main class=" bg-gray-50 min-h-screen pt-20 pb-5">
            @if ($errors->any())
                <div class="w-full  px-2 py-3">
                    <div class="container mx-auto rounded bg-red-200 p-2 border border-red-600">
                        <p class="font-bold text-md dark:text-black">Error List</p>
                        <ul class="list-disc ms-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li class="text-red-600">{!! $error !!}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            {{ $slot }}
        </main>
    </div>

    <!-- Menu Dial -->
    <div class="fixed flex end-6 bottom-6">
        <livewire:keranjang.handle />
    </div>
    @guest
        <!-- Modal Login -->
        <div id="login" tabindex="-1" data-modal-backdrop="static"
            class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-xl max-h-full">
                <div class="relative bg-gray-100 border rounded-md shadow-sm">
                    <button data-modal-hide="login"
                        class="absolute top-[-10px] right-[-10px] bg-white border border-gray-500 rounded-full p-1">
                        <svg class="w-5 h-5 font-bold hover:animate-spin text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                    </button>
                    <div class="p-6 space-y-4 md:space-y-5 sm:p-8">
                        <h1
                            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Silahkan login untuk melanjutkan !!!
                        </h1>
                        <a href="{{ route('google.redirect') }}"
                            class="border border-gray-500 py-2 rounded-md flex justify-center hover:bg-gray-300 items-center gap-2 w-100 fw-semibold">
                            <img src="{{ asset('assets/google.webp') }}" class="size-5" alt="Google">
                            Masuk dengan Google
                        </a>
                        <div class="grid grid-cols-5 items-center">
                            <hr class="col-span-2">
                            <span class="col-span-1 text-center text-gray-400">atau</span>
                            <hr class="col-span-2">
                        </div>
                        <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="email@example.com" required autofocus>
                            </div>
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi</label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required autocomplete="current-password">
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="remember" aria-describedby="remember" name="remember" type="checkbox"
                                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-yellow-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-yellow-600 dark:ring-offset-gray-800">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="remember" class="text-gray-500 dark:text-gray-300">Ingat saya</label>
                                    </div>
                                </div>
                                <a href="{{ route('password.request') }}"
                                    class="text-sm font-medium text-yellow-600 hover:underline dark:text-yellow-500">Lupa
                                    kata sandi?</a>
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Masuk</button>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Belum memiliki akun? <a href="{{ route('register')}}"
                                    class="font-medium text-yellow-600 hover:underline dark:text-yellow-500">Daftar</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endguest
    @include('sweetalert::alert')
</body>

</html>