<x-guest-layout title="Lupa Password">
    <div
        class="max-w-screen-xl flex items-center justify-center px-3 md:px-6 py-6 mx-auto  font-inter dark:text-white h-full">
        <div
            class="w-full h-full  rounded-lg  shadow-lg border md:mt-0 sm:max-w-md xl:p-0 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700">
            <div class="p-6 sm:p-8">
                <h4 class="text-2xl font-bold">LUPA <span class="text-gold">KATA SANDI</span></h4>
                <hr class="dark:border-gray-500 my-5">
                <p class="dark:text-gray-300 text-justify mb-4 mt-3">Masukkan alamat email yang terdaftar untuk menerima
                    tautan pengaturan ulang kata sandi.</p>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <label for="email" class="dark:text-white">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus
                        class="bg-gray-50 border mt-2 border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "
                        placeholder="email@example.com" required>
                    <button type="submit"
                        class="bg-gold hover:opacity-85 w-full py-2 rounded-lg mt-4 text-black font-bold text-sm">KIRIM
                        LINK RESET PASSWORD</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>