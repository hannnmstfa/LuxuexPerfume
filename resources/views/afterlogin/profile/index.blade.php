<x-guest-layout title="Profile">
    <div class="max-w-7xl mx-auto px-6 py-10 md:py-12 text-center">
        <h1 class="text-3xl md:text-4xl font-semibold tracking-tight">
            INFORMASI <span class="text-gold">PROFIL</span>
        </h1>
    </div>
    <div
        class="rounded-3xl max-w-screen-xl mx-auto border border-white/30 bg-white/5 backdrop-blur-xl p-6 md:p-10 leading-relaxed mb-5">
        <h4 class="text-xl font-bold">DETAIL <span class="text-gold">PRIBADI</span></h4>
        <hr class="dark:border-gray-700 my-3">
        <form action="{{ route('profile.store') }}" method="post">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label for="name" class="block mb-1 text-sm font-medium ">Nama Lengkap<span
                        class="text-red-600">*</span></label>
                <input type="name" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Cth: Friska Laguna" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-1 text-sm font-medium ">Email<span
                        class="text-red-600">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white disabled:!bg-gray-600"
                    placeholder="email@example.com" disabled>
                @if ($user->email_verified_at)
                    <div class="text-green-600 text-xs italic mt-1 flex items-center gap-1">Email terverifikasi pada
                        <span class="font-semibold">{{ Auth::user()->email_verified_at }}.</span> <a
                            href="javascript:void(0)" id="gantiEmailBtn" class="text-gold underline text-nowrap">Ganti
                            Email</a>
                        <span class="relative ml-2 group cursor-help">
                            <svg class="w-4 h-4 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.008-3.018a1.502 1.502 0 0 1 2.522 1.159v.024a1.44 1.44 0 0 1-1.493 1.418 1 1 0 0 0-1.037.999V14a1 1 0 1 0 2 0v-.539a3.44 3.44 0 0 0 2.529-3.256 3.502 3.502 0 0 0-7-.255 1 1 0 0 0 2 .076c.014-.398.187-.774.48-1.044Zm.982 7.026a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2h-.01Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div
                                class="invisible group-hover:visible absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap z-10 shadow-lg before:content-[''] before:absolute before:top-full before:left-1/2 before:transform before:-translate-x-1/2 before:border-4 before:border-gray-900 before:border-t-gray-900 before:border-l-transparent before:border-r-transparent before:border-b-transparent">
                                Jika email diganti, Anda harus melakukan verifikasi ulang email.
                            </div>
                        </span>
                    </div>
                @endif
            </div>
            <div class="mb-4">
                <label for="phone" class="block mb-1 text-sm font-medium ">No Telepon<span
                        class="text-red-600">*</span></label>
                <input type="phone" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="email@example.com" required>
            </div>
            <div class="mb-4">
                <label for="alamat" class="block mb-1 text-sm font-medium ">Alamat Lengkap<span
                        class="text-red-600">*</span></label>
                <textarea name="alamat" id="alamat" rows="7"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Cth: Jl Jendral Soedirman No.5, Kota Kudus, Kudus, Jawa Tengah"
                    required>{{ old('alamat', $user->alamat) }}</textarea>
            </div>
            <button type="submit"
                class="bg-gold w-full text-center text-sm mb-4 rounded-lg text-black py-2 font-bold hover:opacity-85">SIMPAN
                PERUBAHAN</button>
        </form>
    </div>
    <div
        class="rounded-3xl max-w-screen-xl mx-auto border border-white/30 bg-white/5 backdrop-blur-xl p-6 md:p-10 leading-relaxed mb-5">
        <h4 class="text-xl font-bold">UBAH <span class="text-gold">KATA SANDI</span></h4>
        <hr class="dark:border-gray-700 my-3">
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="current_password" class="block mb-1 text-sm font-medium ">Kata sandi saat ini<span
                        class="text-red-600">*</span></label>
                <input type="text" name="current_password" id="current_password" autocomplete="off"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Kata sandi saat ini" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-1 text-sm font-medium ">Kata sandi baru<span
                        class="text-red-600">*</span></label>
                <input type="text" name="password" id="password" autocomplete="off"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Kata sandi baru" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block mb-1 text-sm font-medium ">Konfirmasi kata sandi
                    baru<span class="text-red-600">*</span></label>
                <input type="text" name="password_confirmation" id="password_confirmation" autocomplete="off"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Konfirmasi kata sandi baru" required>
            </div>
            <button type="submit"
                class="bg-gold w-full text-center text-sm mb-4 rounded-lg text-black py-2 font-bold hover:opacity-85">SIMPAN
                KATA SANDI</button>
        </form>
    </div>

    <div
        class="rounded-3xl max-w-screen-xl mx-auto border border-red-600/30 bg-white/5 backdrop-blur-xl p-6 md:p-10 leading-relaxed mb-5">
        <h4 class="text-xl font-bold">HAPUS <span class="text-red-600">AKUN</span></h4>
        <hr class="dark:border-gray-700 my-3">
        <p class="text-sm dark:text-gray-400">Akun yang sudah pernah melakukan transaksi berhasil tidak akan terhapus
            secara permanen dari sistem karena digunakan untuk kebutuhan
            pengembangan website, pengelolaan transaksi, dan pengembangan produk. Jika Anda ingin mengajukan penghapusan
            akun secara permanen atau mengaktifkan kembali akun, silakan hubungi Customer Service kami untuk
            proses lebih lanjut.</p>
        <button type="button" data-modal-target="hapusAkun" data-modal-toggle="hapusAkun"
            class="bg-red-700 w-full text-center text-sm mb-4 rounded-lg text-white py-2 font-bold hover:opacity-85 mt-4">HAPUS
            AKUN</button>
    </div>
</x-guest-layout>
<div id="hapusAkun" tabindex="-1" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <div class="relative  bg-black/50 backdrop-blur border rounded-md shadow-sm dark:text-white">
            <button data-modal-hide="hapusAkun"
                class="absolute top-[-10px] right-[-10px] bg-white dark:bg-black border border-gray-500 rounded-full p-1">
                <svg class="w-5 h-5 font-bold hover:animate-spin text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </button>
            <div class="p-6 space-y-4 md:space-y-5 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Konfirmasi hapus akun
                </h1>
                <hr class="dark:border-gray-700 my-3">
                <form method="post" action="{{ route('profile.destroy', Auth::user()->email) }}">
                    @csrf
                    @method('delete')
                    <div class="mb-4">
                        <label for="password" class="block mb-1 text-sm font-medium ">Kata sandi saat ini<span
                                class="text-red-600">*</span></label>
                        <input type="text" name="password" id="password" autocomplete="off"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Kata sandi saat ini" required>
                    </div>
                    <button type="submit"
                        class="bg-red-700 w-full text-center text-sm mb-4 rounded-lg text-white py-2 font-bold hover:opacity-85">HAPUS
                        AKUN</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const gantiEmailBtn = document.getElementById('gantiEmailBtn');
    if (gantiEmailBtn) {
        gantiEmailBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const emailInput = document.getElementById('email');
            if (emailInput) {
                emailInput.disabled = false;
                emailInput.focus();
            }
        });
    }
</script>