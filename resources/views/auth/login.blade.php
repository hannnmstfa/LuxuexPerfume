<x-guest-layout title="Masuk">
    <div class="flex items-center justify-center px-6 py-6 mx-auto  font-inter text-white h-full">
        <div
            class="w-full h-full  rounded-lg  shadow-lg border md:mt-0 sm:max-w-md xl:p-0 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-5 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight">
                    Selamat datang kembali!
                </h1>
                <a href="{{ route('google.redirect') }}"
                    class="border border-gray-500 py-2 rounded-md flex justify-center hover:bg-yellow-800 items-center gap-2 w-100 fw-semibold">
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
                        <label for="email" class="block mb-2 text-sm font-medium ">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="email@example.com" required autofocus>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block mb-2 text-sm font-medium">Kata
                                Sandi</label>
                            <div class="flex items-center">
                                <label class="flex items-center cursor-pointer gap-1">
                                    <input type="checkbox" id="show" class="sr-only peer">
                                    <div
                                        class="relative w-7 h-4 bg-gray-200 dark:bg-gray-700 peer-focus:outline-none after:bg-gray-300 peer-checked:after:bg-orange-700  rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-gold">
                                    </div>
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-300">Tampilkan</span>
                                </label>
                            </div>
                        </div>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required autocomplete="current-password">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" name="remember" type="checkbox"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-yellow-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 checked:bg-gold">
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
                        class="w-full text-white bg-yellow-400 hover:bg-opacity-90 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Masuk</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Belum memiliki akun? <a href="{{ route('register')}}"
                            class="font-medium text-yellow-600 hover:underline dark:text-yellow-500">Daftar</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
<script>
    window.addEventListener("DOMContentLoaded", function () {
        document.getElementById('show').addEventListener('click', function () {
            var passwordField = document.getElementById('password');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    });
</script>