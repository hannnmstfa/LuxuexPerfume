<div class="max-w-screen-xl mx-auto">
    <form action="{{ route('checkout.store') }}" method="post"
        class="grid grid-cols-12 gap-4 justify-center items-start space-y-2 lg:space-y-0 p-3 font-inter">
        @csrf
        <div class="col-span-12 lg:col-span-8 space-y-6">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-semibold text-xl mb-2">
                    Data Penerima
                </h2>
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

            <div class="bg-white p-6 rounded shadow relative">
                <div wire:loading.remove.class="hidden" wire:loading.class="flex"
                    wire:target="provinsi(), kota(), kecamatan(), desa()"
                    class="absolute w-full top-0 left-0 right-0 bottom-0 bg-gray-500 hidden justify-center items-center bg-opacity-50">
                    <x-loader />
                </div>
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
                        <textarea name="alamat" placeholder="Tulis alamat lengkap atau detail lokasimu disini..." rows="5"
                            class="bg-gray-50 border text-sm border-gray-300 text-gray-900 rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            id="alamat" required>{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <div wire:loading.remove.class="hidden" wire:loading.class="flex" wire:target="setPayment"
                    class="absolute w-full top-0 left-0 right-0 bottom-0 bg-gray-500 hidden justify-center items-center bg-opacity-50">
                    <x-loader />
                </div>
                <div class="border {{ $errors->has('payment_method') ? '' : 'hidden' }} rounded border-red-500 mb-3 text-red-500 bg-red-200 p-2 flex justify-start items-center gap-2">
                    <svg class="w-6 h-6" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p>Silahkan Pilih metode pembayaran terlebih dahulu</p>
                </div>
                <h2 class="font-semibold text-xl">Metode Pembayaran</h2>
                <hr class="py-2">
                <div class="grid grid-cols-3 gap-2 space-y-2 md:space-y-0">
                    <span class="col-span-3 font-semibold">Virtual Account</span>
                    @foreach ($payment['data'] as $va)
                        @if ($va['group'] == 'Virtual Account')
                            <div class="col-span-3 md:col-span-1">
                                <input type="radio" name="payment_method" value="{{ $va['code'] }}" class="peer hidden"
                                    id="{{ $va['code'] }}">
                                <label for="{{ $va['code'] }}" title="{{ $va['name'] }}"
                                    class="w-full min-h-20 border flex flex-col justify-center peer-checked:bg-yellow-100 peer-checked:border-2 peer-checked:border-yellow-400 gap-2 items-center border-gray-300 bg-gray-100 hover:bg-gray-200 cursor-pointer duration-100 rounded p-2">
                                    <img src="{{ $va['icon_url'] }}" class="w-20" alt="{{ $va['name'] }}">
                                    <span class="text-xs text-gray-400 font-poppins italic">Fee Rp{{ $va['total_fee']['flat'] }} + PPN {{ $va['total_fee']['percent'] }}%</span>
                                </label>
                            </div>
                        @endif
                    @endforeach
                    <span class="col-span-3 font-semibold pt-3">Toko Retail</span>
                    @foreach ($payment['data'] as $retail)
                        @if ($retail['group'] == 'Convenience Store')
                            <div class="col-span-3 md:col-span-1">
                                <input type="radio" name="payment_method" value="{{ $retail['code'] }}" class="peer hidden"
                                    id="{{ $retail['code'] }}" >
                                <label for="{{ $retail['code'] }}" title="{{ $retail['name'] }}"
                                    class="w-full min-h-20 border flex flex-col justify-center peer-checked:bg-yellow-100 peer-checked:border-2 peer-checked:border-yellow-400 gap-2 items-center border-gray-300 bg-gray-100 hover:bg-gray-200 cursor-pointer duration-100 rounded p-2">
                                    <img src="{{ $retail['icon_url'] }}" class="w-20" alt="{{ $retail['name'] }}">
                                    <span class="text-xs text-gray-400 font-poppins italic">Fee Rp{{ $retail['total_fee']['flat'] }} + PPN {{ $retail['total_fee']['percent'] }}%</span>
                                </label>
                            </div>
                        @endif
                    @endforeach
                    <span class="col-span-3 font-semibold pt-3">E-Wallet</span>
                    @foreach ($payment['data'] as $ewallet)
                        @if ($ewallet['group'] == 'E-Wallet')
                            <div class="col-span-3 md:col-span-1">
                                <input type="radio" name="payment_method" value="{{ $ewallet['code'] }}" class="peer hidden"
                                    id="{{ $ewallet['code'] }}" >
                                <label for="{{ $ewallet['code'] }}" title="{{ $ewallet['name'] }}"
                                    class="w-full min-h-20 border flex flex-col justify-center peer-checked:bg-yellow-100 peer-checked:border-2 peer-checked:border-yellow-400 gap-2 items-center border-gray-300 bg-gray-100 hover:bg-gray-200 cursor-pointer duration-100 rounded p-2">
                                    <img src="{{ $ewallet['icon_url'] }}" class="w-20" alt="{{ $ewallet['name'] }}">
                                    <span class="text-xs text-gray-400 font-poppins italic">Fee Rp{{ $ewallet['total_fee']['flat'] }} + PPN {{ $ewallet['total_fee']['percent'] }}%</span>
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>


        <!-- KANAN -->
        <div class="col-span-12 lg:col-span-4">
            <div class="border border-gray-300 rounded-md p-4 shadow-md relative font-inter">
                <div wire:loading.remove.class="hidden" wire:loading.class="flex" wire:target="hitungPayment()"
                    class="absolute w-full top-0 left-0 right-0 bottom-0 bg-gray-500 hidden justify-center items-center bg-opacity-50">
                    <x-loader />
                </div>
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
                        @forelse ($keranjangs as $item)
                            <tr class="border-b">
                                <td class="py-1">{{ $item->jumlah }}</td>
                                <td class="py-1"><span class="line-clamp-1"
                                        title="{{ $item->produks->nama }}">{{ $item->produks->nama }}</span></td>
                                <td class="text-right py-1">
                                    Rp{{ number_format(($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center italic border-b">Belum ada data</td>
                            </tr>
                        @endforelse
                        <tr></tr>
                    </tbody>
                </table>
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <h4 class="font-semibold ">Subtotal</h4>
                    <h4 class="font-semibold ">Rp{{ number_format($subtotal) }}</h4>
                </div>
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <h4 class="font-semibold ">Ongkir</h4>
                    <h4 class="font-semibold ">Rp{{ number_format($ongkir) }}</h4>
                </div>
                <div class="flex justify-between items-center text-lg font-bold">
                    <h4>Total Bayar</h4>
                    <h4>Rp{{ number_format($total) }}</h4>
                </div>
                <hr>
                <button type="submit"
                    class="w-full mt-3 font-semibold bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-md">
                    Lanjut ke Pembayaran
                </button>
            </div>
        </div>

    </form>
</div>