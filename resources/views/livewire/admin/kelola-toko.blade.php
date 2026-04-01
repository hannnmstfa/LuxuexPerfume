<div
    class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur border dark:border-gray-700 p-5 mt-5 relative">
    <div wire:loading.remove.class="hidden" wire:loading.class="flex"
        class="absolute w-full top-0 left-0 right-0 bottom-0 bg-gray-500 hidden justify-center rounded-lg items-center bg-opacity-50">
        <x-loader />
    </div>
    <form action="{{ route('admToko.store') }}" method="post" class="grid grid-cols-12 gap-4">
        @csrf
        <div class="col-span-12 md:col-span-3 mb-4">
            <label for="logo" class="font-semibold text-lg">Logo Toko</label>
            <div class="flex flex-col justify-center items-center mt-2">
                <div class="border border-gray-600 rounded-lg size-56 h-auto">
                    @if ($toko && $toko->path_logo)
                        <img src="{{ asset($toko->path_logo) }}" class="rounded-lg" alt="Logo Toko">
                    @else
                        <div class="flex justify-center items-center h-full">
                            <p class="dark:text-gray-600 text-xs italic">Belum ada logo</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mt-2" wire:ignore>
                <label for="upload-logo" class="text-sm text-gray-300">Upload Logo</label>
                <input type="file" name="logo" accept="image/*" hidden>
                <x-filepond wire:ignore />
            </div>
        </div>
        <div class="col-span-12 md:col-span-9">
            <div class="mb-4">
                <label for="nama" class="font-semibold text-lg">Nama Toko<span class="text-red-600">*</span></label>
                <input type="text"
                    class="rounded w-full border-gray-300 text-sm  dark:bg-gray-900 dark:border-gray-600 dark:text-white mt-2"
                    name="nama_toko" value="{{ old('nama_toko',$toko->nama_toko ?? '') }}"  placeholder="Cth: Toko Parfum Luxuex" required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="col-span-1">
                    <label for="email" class="font-semibold text-lg">Email Toko<span
                            class="text-red-600">*</span></label>
                    <input type="text"
                        class="rounded w-full border-gray-300 text-sm  dark:bg-gray-900 dark:border-gray-600 dark:text-white mt-2"
                        name="email_toko" value="{{ old('alamat_toko', $toko->email_toko ?? '') }}"  placeholder="Cth: luxuexperfume@official.com"
                        required>
                    <span class="text-[0.6rem] text-gold">*Email ini akan digunakan untuk mendapatkan notifikasi saat ada pesanan
                        masuk</span>
                </div>
                <div class="col-span-1">
                    <label for="phone" class="font-semibold text-lg">Telepon Toko<span
                            class="text-red-600">*</span></label>
                    <input type="text"
                        class="rounded w-full border-gray-300 text-sm  dark:bg-gray-900 dark:border-gray-600 dark:text-white mt-2"
                        name="phone_toko" value="{{ old('phone_toko', $toko->phone_toko ?? '') }}"  placeholder="Cth: 08xxxxxxxxxx" required>
                        <span class="text-[0.6rem] text-gold">*No telepon digunakan jika terjadi kendala pada website atau pengiriman</span>
                </div>
            </div>
            <div class="mb-4">
                <label for="alamat" class="font-semibold text-lg">Alamat Toko<span class="text-red-600">*</span></label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                    <div class="col-span-1">
                        <label for="provinsi"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Provinsi<span
                                class="text-red-600">*</span></label>
                        <select wire:model.live="provinsi" autocomplete="off" id="provinsi"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required>
                            <option value="" disabled selected>-- Pilih Provinsi --</option>
                            @foreach ($dataProv['data'] as $prov)
                                <option value="{{ $prov['code'] }}">{{ $prov['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1 {{ empty($dataKota) ? 'hidden' : '' }}">
                        <label for="kota"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kabupaten/Kota<span
                                class="text-red-600">*</span></label>
                        <select wire:model.live="kota" id="kota"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required>
                            <option value="" selected disabled>-- Pilih Kota --</option>
                            @if ($dataKota)
                                @foreach ($dataKota['data'] as $kota)
                                    <option value="{{ $kota['code'] }}">{{ $kota['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-span-1 {{ empty($dataKec) ? 'hidden' : '' }}">
                        <label for="kecamatan"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kecamatan<span
                                class="text-red-600">*</span></label>
                        <select wire:model.live="kecamatan" id="kecamatan"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required>
                            <option value="" selected disabled>-- Pilih Kecamatan --</option>
                            @if ($dataKec)
                                @foreach ($dataKec['data'] as $kec)
                                    <option value="{{ $kec['code'] }}">{{ $kec['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-span-1 {{ empty($dataDesa) ? 'hidden' : '' }}">
                        <label for="desa"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kelurahan/Desa<span
                                class="text-red-600">*</span></label>
                        <select name="kode_area" wire:model.live="desa" id="desa"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required>
                            <option value="" selected disabled>-- Pilih desa --</option>
                            @if ($dataDesa)
                                @foreach ($dataDesa['data'] as $desa)
                                    <option value="{{ $desa['code'] }}">{{ $desa['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-span-2 {{ $kodearea == null ? 'hidden' : '' }}">
                        <label for="alamat" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Alamat
                            Lengkap<span class="text-red-600">*</span></label>
                        <textarea name="alamat_toko"  placeholder="Tulis alamat lengkap toko disini..." rows="5"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            id="alamat" required>{{ old('alamat_toko', $toko->alamat_toko ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center">
                <button type="submit"
                    class="bg-gold w-full py-2 rounded-lg text-black font-semibold hover:opacity-80">Simpan
                    Perubahan</button>
            </div>
        </div>
    </form>
</div>