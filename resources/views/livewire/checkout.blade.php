<div class="max-w-screen-xl mx-auto">
    <form action="#" method="post"
        class="grid grid-cols-12 gap-4 justify-center items-start space-y-2 lg:space-y-0 p-3 font-inter">
        @csrf
        <div class="col-span-12 lg:col-span-8 space-y-6">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-semibold text-xl">Data Penerima</h2>
                <hr class="py-2">
                <div class="grid grid-cols-2 gap-2 space-y-2 lg:space-y-0">
                    <div class="col-span-2 lg:col-span-1">
                        <label for="nama_penerima"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama<span
                                class="text-red-600">*</span></label>
                        <input type="text" name="nama_penerima" id="nama_penerima"
                            value="{{ old('nama_penerima', Auth::user()->name) }}"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Cth: Friska Laguna" required autofocus>
                    </div>
                    <div class="col-span-2 lg:col-span-1">
                        <label for="no_penerima"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                            Telepon<span class="text-red-600">*</span></label>
                        <input type="tel" pattern="08[0-9]{8,11}" name="no_penerima" id="no_penerima"
                            value="{{ old('no_penerima', Auth::user()->phone) }}"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Cth: 08xxxxxxxxx" required>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-semibold text-xl">Alamat Pengiriman</h2>
                <hr class="py-2">
                <div class="grid grid-cols-2 gap-2 space-y-2 lg:space-y-0">
                    <div class="col-span-2 lg:col-span-1">
                        <label for="provinsi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi<span
                                class="text-red-600">*</span></label>
                        <select wire:model.live="provinsi" autocomplete="off" id="provinsi"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="" disabled selected>-- Pilih Provinsi --</option>
                            @foreach ($dataProv['data'] as $prov)
                                <option value="{{ $prov['code'] }}">{{ $prov['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2 lg:col-span-1 {{ empty($dataKota) ? 'hidden' : '' }}">
                        <label for="kota"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten/Kota<span
                                class="text-red-600">*</span></label>
                        <select wire:model.live="kota" id="kota"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="" selected disabled>-- Pilih Kota --</option>
                            @if ($dataKota)
                                @foreach ($dataKota['data'] as $kota)
                                    <option value="{{ $kota['code'] }}">{{ $kota['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-span-2 lg:col-span-1 {{ empty($dataKec) ? 'hidden' : '' }}">
                        <label for="kecamatan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan<span
                                class="text-red-600">*</span></label>
                        <select wire:model.live="kecamatan" id="kecamatan"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="" selected disabled>-- Pilih Kecamatan --</option>
                            @if ($dataKec)
                                @foreach ($dataKec['data'] as $kec)
                                    <option value="{{ $kec['code'] }}">{{ $kec['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-span-2 lg:col-span-1 {{ empty($dataDesa) ? 'hidden' : '' }}">
                        <label for="desa"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelurahan/Desa<span
                                class="text-red-600">*</span></label>
                        <select name="kode_area" wire:model.live="desa" id="desa"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="" selected disabled>-- Pilih desa --</option>
                            @if ($dataDesa)
                                @foreach ($dataDesa['data'] as $desa)
                                    <option value="{{ $desa['code'] }}">{{ $desa['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-span-2 {{ empty($dataDesa) ? 'hidden' : '' }}">
                        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
                            Lengkap<span class="text-red-600">*</span></label>
                        <textarea name="alamat" placeholder="Tulis alamat lengkapmu disini..." rows="5"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            id="alamat" required>{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- KANAN -->
        <div class="col-span-12 lg:col-span-4">
            <div class="border border-gray-300 rounded-md p-4 shadow-md relative font-inter">
                <h2 class="text-xl font-bold mb-4">Ringkasan Pesanan</h2>
                <table class="w-full text-sm font-inter mb-3">
                    <thead>
                        <tr class="border-b font-semibold">
                            <td>Jml</td>
                            <td>Produk</td>
                            <td class="text-right">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjangs as $item)
                            <tr class="border-b">
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->produks->nama }}</td>
                                <td class="text-right">
                                    Rp{{ number_format(($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah) }}
                                </td>
                            </tr>
                        @endforeach
                        <tr></tr>
                    </tbody>
                </table>
                <div class="flex justify-between items-center text-md text-gray-500">
                    <h4 class="font-semibold ">Subtotal</h4>
                    <h4 class="font-semibold ">Rp{{ number_format($subtotal) }}</h4>
                </div>
                <div class="flex justify-between items-center text-md text-gray-500">
                    <h4 class="font-semibold ">Ongkir</h4>
                    <h4 class="font-semibold ">Rp{{ number_format($ongkir) }}</h4>
                </div>
                <hr>
                <div class="flex justify-between items-center text-lg font-bold">
                    <h4>Total Bayar</h4>
                    <h4>Rp{{ number_format($subtotal + $ongkir) }}</h4>
                </div>
                <button class="w-full mt-4 bg-yellow-600 text-white py-3 rounded">
                    Bayar Sekarang
                </button>
            </div>
        </div>

    </form>
</div>