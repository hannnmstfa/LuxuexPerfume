<x-guest-layout title="Atur Ulang Kata Sandi">
    <div
        class="max-w-screen-xl flex items-center justify-center px-3 md:px-6 py-6 mx-auto  font-inter dark:text-white h-full">
        <div
            class="w-full h-full  rounded-lg  shadow-lg border md:mt-0 sm:max-w-md xl:p-0 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700">
            <div class="p-6 sm:p-8">
                <h4 class="text-2xl font-bold">ATUR ULANG <span class="text-gold">KATA SANDI</span></h4>
                <hr class="dark:border-gray-500 my-5">
                <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email', $request->email)" required readonly />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autofocus="true"
                        autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="my-4">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                <button type="submit"
                        class="bg-gold hover:opacity-85 w-full py-2 rounded-lg text-black font-bold text-sm">SIMPAN PERUBAHAN</button>
            </form>
            </div>
        </div>
    </div>
</x-guest-layout>