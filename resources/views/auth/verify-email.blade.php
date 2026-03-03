<x-guest-layout title="Verifikasi Email">
    <div
        class="max-w-screen-xl flex items-center justify-center px-3 md:px-6 py-6 mx-auto  font-inter dark:text-white h-full">
        <div
            class="w-full h-full  rounded-lg  shadow-lg border md:mt-0 sm:max-w-md xl:p-0 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700">
            <div class="p-6 sm:p-8">
                <h4 class="text-2xl font-bold">VERIFIKASI <span class="text-gold">AKUN</span></h4>
                <hr class="dark:border-gray-500 my-5">
                <p class="font-semibold">Terima kasih telah mendaftar di LuxuexPerfume!</p>
                <p class="dark:text-gray-300 text-justify mt-3">Silakan verifikasi akun Anda terlebih dahulu dengan
                    mengklik link
                    verifikasi yang telah kami kirimkan ke email Anda agar akun dapat digunakan sepenuhnya. Jika anda
                    belum menerima email verifikasi silahkan klik tombol dibawah ini.</p>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="bg-gold hover:opacity-85 w-full py-2 rounded-lg mt-4 text-black font-bold text-sm">KIRIM
                        ULANG EMAIL VERIFIKASI</button>
                </form>
                @if (session('status') == 'verification-link-sent')
                    <p class="mt-4 font-medium text-sm text-green-600 dark:text-green-400">
                        Tautan verifikasi email telah berhasil dikirim ulang. Mohon untuk memeriksa kotak masuk atau folder
                        Spam apabila email belum terlihat
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>