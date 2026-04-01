<x-app-layout title="Kelola Produk">
    <div
        class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Kelola Produk</h5>
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                            <svg class="w-3 h-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span
                                class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Produk</span>
                        </div>
                    </li>
                </ol>
            </div>
            <button data-modal-target="parfum" data-modal-toggle="parfum"
                class="flex items-center justify-center px-4 py-2 text-sm font-semibold text-white rounded-lg bg-yellow-700 dark:bg-gold dark:text-black hover:opacity-75 focus:ring-4 focus:ring-yellow-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="w-5 h-5 mr-2 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Parfum
            </button>
        </div>
    </div>

    <div
        class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur border dark:border-gray-700 p-3 mt-5">
        <x-loader />
        <table id="myTable" class="hidden w-full text-sm text-center dark:text-gray-400">
            <thead>
                <tr class="">
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black text-center">
                        No
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black text-center">
                        Produk
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black text-center">
                        Kategori
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black">
                        Deskripsi
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black">
                        Harga
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black">
                        Stok
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produks as $index => $parfum)
                    <tr
                        class="odd:bg-gray-50 even:bg-gray-200 dark:odd:bg-gray-800/40 dark:even:bg-gray-700/40 dark:backdrop-blur">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <div class="flex w-full justify-center items-center flex-col">
                                <img src="{{ asset($parfum->path_foto) }}" class=" md:h-32 rounded border"
                                    alt="Pic. {{ $parfum->nama }}">
                                <p class="font-semibold text-center">{{ $parfum->nama }}</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <span
                                class="rounded-full px-3 py-1 text-[11px] font-semibold {{ $parfum->kategori == 'pria' ? 'bg-gold border border-white/15 text-black' : 'bg-pink-400 text-black' }}">
                                {{ ucfirst($parfum->kategori) }}
                            </span>
                        </td>
                        <td class="text-xs" title="{{ $parfum->deskripsi }}">{{ Str::limit($parfum->deskripsi, 100) }}</td>
                        <td>
                            <p class="{{ $parfum->harga_diskon ? 'line-through text-xs text-red-500' : 'font-bold' }}">
                                Rp{{ number_format($parfum->harga) }}</p>
                            <p class="{{ $parfum->harga_diskon ? 'font-bold' : 'hidden' }}">
                                Rp{{ number_format($parfum->harga_diskon) }}</p>
                        </td>
                        <td>
                            <span
                                class="text-nowrap {{ $parfum->stok < 1 ? 'text-red-600 border p-1 rounded-full bg-red-100 border-red-400' : '' }} font-semibold">{{ $parfum->stok < 1 ? 'Stok Habis' : $parfum->stok }}</span>
                        </td>
                        <td>
                            <div class="flex flex-col justify-center items-center gap-1">
                                <button
                                    class="bg-yellow-400 text-center  rounded font-semibold text-white py-1 px-3 w-full dark:bg-yellow-300 dark:text-black hover:opacity-75"
                                    data-modal-target="parfum-{{ $index }}" data-modal-toggle="parfum-{{ $index }}"
                                    title="Edit">
                                    Edit
                                </button>
                                <a href="{{ route('admProduk.destroy', $parfum->id) }}" title="Hapus Parfum"
                                    class="py-1 px-3 w-full text-center font-semibold text-white rounded bg-red-600 dark:bg-red-500 hover:opacity-75"
                                    data-confirm-delete="true">
                                    Hapus
                                </a>
                                <button data-modal-target="diskon-{{ $index }}" title="Atur Harga Diskon"
                                    data-modal-toggle="diskon-{{ $index }}"
                                    class="text-center w-full text-nowrap bg-gray-300 dark:bg-gray-500 dark:text-white font-semibold hover:opacity-75 rounded py-1 px-2">
                                    Atur Diskon
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div id="parfum" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Data Parfum
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="parfum">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form action="{{ route('admProduk.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kategori" class="font-medium text-sm">Kategori<span
                                    class="text-red-600">*</span></label>
                            <select name="kategori" id="kategori" class="block w-full text-sm rounded border-gray-300 dark:bg-gray-800 dark:border-gray-500"
                                required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                <option value="pria" {{ old('kategori') == 'pria' ? 'selected' : '' }}>Pria</option>
                                <option value="wanita" {{ old('kategori') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="font-medium text-sm">Nama Parfum<span
                                    class="text-red-600">*</span></label>
                            <input type="text" class="rounded w-full border-gray-300 text-sm  dark:bg-gray-800 dark:border-gray-500" name="nama"
                                value="{{ old('nama') }}" placeholder="Cth: Sauvage Dior" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="font-medium text-sm">Harga<span
                                    class="text-red-600">*</span></label>
                            <input type="number" min="1" class="rounded w-full border-gray-300 text-sm dark:bg-gray-800 dark:border-gray-500" min="1"
                                name="harga" value="{{ old('harga') }}" placeholder="Cth: 25000" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="font-medium text-sm">Stok<span
                                    class="text-red-600">*</span></label>
                            <input type="number" min="0" class="rounded w-full border-gray-300 text-sm dark:bg-gray-800 dark:border-gray-500" name="stok"
                                value="{{ old('stok') }}" placeholder="Cth: 25" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="font-medium text-sm">Deskripsi<span
                                    class="text-red-600">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" rows="5"
                                class="block w-full text-sm rounded border-gray-300  dark:bg-gray-800 dark:border-gray-500" placeholder="Deskripsi parfum..."
                                required>{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="font-medium text-sm">Gambar Parfum<span
                                    class="text-red-600">*</span></label>
                            <input type="file" accept="image/*" class="rounded w-full ring-gray-300 text-sm ring-1 dark:bg-gray-800 dark:ring-gray-500"
                                name="gambar" required>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambahkan
                            Parfum</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($produks->isNotEmpty())
        <!-- Modal Edit -->
        @foreach ($produks as $i => $edit)
            <div id="parfum-{{ $i }}" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Data Parfum
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="parfum-{{ $i }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form action="{{ route('admProduk.update', $edit->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="kategori" class="font-medium text-sm">Kategori<span
                                            class="text-red-600">*</span></label>
                                    <select name="kategori" id="kategori" class="block w-full text-sm rounded border-gray-300 dark:bg-gray-800 dark:border-gray-500"
                                        required>
                                        <option value="" selected disabled>-- Pilih Kategori --</option>
                                        <option value="pria" {{ old('kategori', $edit->kategori) == 'pria' ? 'selected' : '' }}>
                                            Pria</option>
                                        <option value="wanita" {{ old('kategori', $edit->kategori) == 'wanita' ? 'selected' : '' }}>Wanita</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="font-medium text-sm">Nama Parfum<span
                                            class="text-red-600">*</span></label>
                                    <input type="text" class="rounded w-full border-gray-300 text-sm dark:bg-gray-800 dark:border-gray-500" name="nama"
                                        value="{{ old('nama', $edit->nama) }}" placeholder="Cth: Sauvage Dior" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="font-medium text-sm">Harga<span
                                            class="text-red-600">*</span></label>
                                    <input type="number" min="1" class="rounded w-full border-gray-300 text-sm dark:bg-gray-800 dark:border-gray-500" min="1"
                                        name="harga" value="{{ old('harga', $edit->harga) }}" placeholder="Cth: 25000" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="font-medium text-sm">Stok<span
                                            class="text-red-600">*</span></label>
                                    <input type="number" min="0" class="rounded w-full border-gray-300 text-sm dark:bg-gray-800 dark:border-gray-500" name="stok"
                                        value="{{ old('stok', $edit->stok) }}" placeholder="Cth: 25" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="font-medium text-sm">Deskripsi<span
                                            class="text-red-600">*</span></label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4"
                                        class="block w-full text-sm rounded border-gray-300 dark:bg-gray-800 dark:border-gray-500" placeholder="Deskripsi parfum..."
                                        required>{{ old('deskripsi', $edit->deskripsi) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="font-medium text-sm">Gambar Parfum<span
                                            class="text-gray-400 italic">(Opsional)</span></label>
                                    <input type="file" accept="image/*" class="rounded w-full ring-gray-300 text-sm ring-1 dark:bg-gray-800 dark:ring-gray-500"
                                        name="gambar">
                                </div>
                                <button type="submit"
                                    class="w-full text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan
                                    Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal Diskon -->
        @foreach ($produks as $i => $diskon)
            <div id="diskon-{{ $i }}" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Atur Harga Diskon
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="diskon-{{ $i }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form action="{{ route('admProduk.setDiskon', $diskon->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="harga_diskon" class="font-medium text-sm">Harga Diskon<span
                                            class="text-red-600">*</span></label>
                                    <input type="number" class="rounded w-full border-gray-300 text-sm dark:bg-gray-800 dark:border-gray-500" min="1"
                                        name="harga_diskon" value="{{ old('harga_diskon', $diskon->harga_diskon) }}"
                                        placeholder="Cth: 50000" required>
                                </div>
                                <hr class="py-2 dark:border-gray-500">
                                <div class="flex flex-col gap-1">
                                    <button type="submit"
                                        class="w-full text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan
                                        Harga Diskon</button>
                                    <a href="{{ route('admProduk.delDiskon', $diskon->id) }}" data-confirm="true"
                                        data-color="#8e4b10" data-title="Konfirmasi !!!" data-icon="warning"
                                        data-caption="Apakah anda ingin menghapus diskon pada {{ $diskon->nama }}?"
                                        class="w-full {{ $diskon->harga_diskon == null ? 'hidden' : '' }} text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Hapus
                                        Harga Diskon</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</x-app-layout>
<x-simple-datatables />