<x-guest-layout title="Pengajuan {{ $trx->kodeTrx }}">
    <div class="max-w-7xl mx-auto px-6 py-10 md:py-12 text-center">
        <h1 class="text-3xl md:text-4xl font-semibold tracking-tight">
            FORM <span class="text-gold">PENGAJUAN</span>
        </h1>
        <P class="text-xs">*isi form dibawah untuk melanjutkan proses pengajuan</P>
    </div>
    <div class="rounded-xl max-w-screen-lg mx-auto border border-white/10 bg-white/5 backdrop-blur-xl p-3 shadow">
        <p class="text-xs mb-3">No.Pesanan <span class="font-bold text-gold">#{{ $trx->kodeTrx }}</span></p>
        <form action="{{ route('pengembalian.store', $trx->kodeTrx) }}" method="post">
            @csrf
            <ul class="w-full px-4 list-decimal">
                <li class="mb-3">
                    <label for="tipe" class="font-semibold">Tipe Pengembalian<span
                            class="text-red-600">*</span></label>
                    <select name="tipe" id="tipe" class="text-sm mt-1 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        <option value="" selected disabled>-- Pilih Tipe Pengembalian --</option>
                        <option value="pengembalian dana">Pengembalian Dana</option>
                        <option value="kirim barang baru">Kirim Barang Baru</option>
                    </select>
                </li>
                <li class="mb-3">
                    <label for="deskripsi" class="font-semibold">Deskripsi Pengembalian<span
                            class="text-red-600">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" rows="5"
                        placeholder="Jelaskan secara singkat alasan pengembalian"
                        class="text-sm mt-1 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ old('alasan') }}</textarea>
                </li>
                <li class="mb-3">
                    <label for="unboxing" class="font-semibold">Video Unboxing<span
                            class="text-red-600">*</span></label>
                    <div id="loader">
                        <x-loader />
                    </div>
                    <input type="file" name="unboxing" accept="video/*" id="unboxing" class="mt-1 hidden" required>
                </li>
                <li class="mb-3">
                    <label for="pendukung" class="font-semibold">Foto Pendukung <span
                            class="text-gray-500 text-sm">(Opsional)</span></label>
                    <div id="loader">
                        <x-loader />
                    </div>
                    <input type="file" name="pendukung[]" accept="image/*" multiple id="pendukung" class="mt-1 hidden">
                </li>   
            </ul>
            <button type="submit" class="w-full bg-gold rounded-lg text-sm font-bold text-black py-2 hover:opacity-80">Ajukan Pengembalian</button>
        </form>
    </div>
</x-guest-layout>
<x-filepond />