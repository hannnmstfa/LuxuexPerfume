<x-guest-layout title="Masuk">
    <div class="flex flex-col items-center justify-center px-6 py-6 mx-auto  font-inter">
        <div
            class="w-full bg-white rounded-lg shadow-lg dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-5 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Selamat datang kembali!
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
                        <input type="email" name="email" id="email"
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
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-yellow-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-yellow-600 dark:ring-offset-gray-800"
                                    >
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
                        Belum memiliki akun? <a href="#"
                            class="font-medium text-yellow-600 hover:underline dark:text-yellow-500">Daftar</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-guest-layout>