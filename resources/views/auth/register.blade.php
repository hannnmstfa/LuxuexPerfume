<x-guest-layout title="Daftar">
    <div class="flex flex-col items-center justify-center px-6 py-6 mx-auto  font-inter">
        <div
            class="w-full bg-white rounded-lg shadow-lg dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-5 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Daftar untuk terhubung dengan kami!
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div>
                        <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Lengkap</label>
                        <input type="text" name="fullname" id="fullname" value="{{ old('fullname') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Cth: Friska Laguna" required autofocus>
                    </div>
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="email@example.com" required>
                    </div>
                    <div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 space-y-2 md:space-y-0">
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata
                                    Sandi</label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    required autocomplete="current-password">
                            </div>
                            <div>
                                <label for="password_confirmation"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Kata
                                    Sandi</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    required autocomplete="current-password">
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" id="show" class="sr-only peer">
                                <div
                                    class="relative w-7 h-4 bg-gray-200 dark:bg-gray-700 peer-focus:outline-none   rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-gray-300 after:border-gray-300 peer-checked:after:bg-orange-700 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-gold">
                                </div>
                                <span class="ms-1 text-xs font-medium text-gray-500 dark:text-gray-300">Tampilkan
                                    Password</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                            Telepon</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="08xxxxxxxxx" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="setuju" aria-describedby="setuju" name="setuju" type="checkbox"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-yellow-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 checked:bg-gold" required>
                            </div>
                            <div class="ml-3 text-xs">
                                <label for="setuju" class="text-gray-500 dark:text-gray-300">Dengan mendaftar, saya menyetujui <a href="{{ route('kebijakan.privasi') }}" class="font-bold text-nowrap dark:text-white hover:underline">Kebijakan Privasi</a> dan <a href="{{ route('ketentuan.layanan') }}" class="font-bold text-nowrap dark:text-white hover:underline">Ketentuan Layanan</a> yang berlaku di <span class="uppercase">{{ config('app.name') }}</span></label>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Daftar</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Sudah memiliki akun? <a href="{{ route('login')}}"
                            class="font-medium text-yellow-600 hover:underline dark:text-yellow-500">Masuk</a>
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
            var confirmField = document.getElementById('password_confirmation');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                confirmField.type = 'text';
            } else {
                passwordField.type = 'password';
                confirmField.type = 'password';
            }
        });
    });
</script>