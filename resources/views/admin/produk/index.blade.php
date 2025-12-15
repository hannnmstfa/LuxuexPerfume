<x-app-layout title="Kelola Produk">
    <div class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-gray-800 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Kelola Produk</h5>
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="w-5 h-5 mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Parfum
            </button>
        </div>
    </div>

    <div class="rounded-lg shadow-lg bg-gray-100 p-3 mt-5 border">
        <x-loader />
        <table id="myTable" class="hidden w-full text-sm text-center dark:text-gray-400">
            <thead>
                <tr class="">
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500 text-center">
                        No
                    </th>
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500 text-center">
                        Parfum
                    </th>
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500 text-center">
                        Kategori
                    </th>
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500">
                        Deskripsi
                    </th>
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500">
                        Harga
                    </th>
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produks as $index => $parfum)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <div class="flex w-full justify-center items-center flex-col">
                                <img src="{{ asset($parfum->path_foto) }}" class=" md:h-32 rounded border"
                                    alt="Pic. {{ $parfum->nama }}">
                                <p class="font-semibold text-center">{{ $parfum->nama }}</p>
                            </div>
                        </td>
                        <td class="text-center">{{ ucfirst($parfum->kategori) }}</td>
                        <td class="text-xs md:text-sm">{{ Str::limit($parfum->deskripsi, 30) }}</td>
                        <td>
                            <div class="flex flex-col items-start justify-center">
                                <span
                                    class="{{ $parfum->harga_diskon == null ? 'font-semibold' : 'text-xs text-red-500 line-through' }}">Rp
                                    {{ number_format($parfum->harga) }}</span>
                                @if ($parfum->harga_diskon == null)
                                    <button data-modal-target="diskon-{{ $index }}" title="Atur Harga Diskon"
                                        data-modal-toggle="diskon-{{ $index }}"
                                        class="flex bg-gray-200 hover:bg-gray-300 rounded p-1 justify-center items-center">
                                        <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M20.29 8.567c.133.323.334.613.59.85v.002a3.536 3.536 0 0 1 0 5.166 2.442 2.442 0 0 0-.776 1.868 3.534 3.534 0 0 1-3.651 3.653 2.483 2.483 0 0 0-1.87.776 3.537 3.537 0 0 1-5.164 0 2.44 2.44 0 0 0-1.87-.776 3.533 3.533 0 0 1-3.653-3.654 2.44 2.44 0 0 0-.775-1.868 3.537 3.537 0 0 1 0-5.166 2.44 2.44 0 0 0 .775-1.87 3.55 3.55 0 0 1 1.033-2.62 3.594 3.594 0 0 1 2.62-1.032 2.401 2.401 0 0 0 1.87-.775 3.535 3.535 0 0 1 5.165 0 2.444 2.444 0 0 0 1.869.775 3.532 3.532 0 0 1 3.652 3.652c-.012.35.051.697.184 1.02ZM9.927 7.371a1 1 0 1 0 0 2h.01a1 1 0 0 0 0-2h-.01Zm5.889 2.226a1 1 0 0 0-1.414-1.415L8.184 14.4a1 1 0 0 0 1.414 1.414l6.218-6.217Zm-2.79 5.028a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ms-1 text-nowrap">Set Discount</span>
                                    </button>
                                @else
                                    <button data-modal-target="diskon-{{ $index }}" title="Atur Harga Diskon"
                                        data-modal-toggle="diskon-{{ $index }}" class="flex justify-start gap-1 items-center">
                                        <div class="bg-gray-200 hover:bg-gray-300 rounded p-1">
                                            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M20.29 8.567c.133.323.334.613.59.85v.002a3.536 3.536 0 0 1 0 5.166 2.442 2.442 0 0 0-.776 1.868 3.534 3.534 0 0 1-3.651 3.653 2.483 2.483 0 0 0-1.87.776 3.537 3.537 0 0 1-5.164 0 2.44 2.44 0 0 0-1.87-.776 3.533 3.533 0 0 1-3.653-3.654 2.44 2.44 0 0 0-.775-1.868 3.537 3.537 0 0 1 0-5.166 2.44 2.44 0 0 0 .775-1.87 3.55 3.55 0 0 1 1.033-2.62 3.594 3.594 0 0 1 2.62-1.032 2.401 2.401 0 0 0 1.87-.775 3.535 3.535 0 0 1 5.165 0 2.444 2.444 0 0 0 1.869.775 3.532 3.532 0 0 1 3.652 3.652c-.012.35.051.697.184 1.02ZM9.927 7.371a1 1 0 1 0 0 2h.01a1 1 0 0 0 0-2h-.01Zm5.889 2.226a1 1 0 0 0-1.414-1.415L8.184 14.4a1 1 0 0 0 1.414 1.414l6.218-6.217Zm-2.79 5.028a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-nowrap hover:underline">Rp
                                            {{ number_format($parfum->harga_diskon) }}</span>
                                    </button>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="flex justify-start items-center gap-1">
                                <button class="bg-yellow-400 hover:bg-yellow-500 rounded p-1"
                                    data-modal-target="parfum-{{ $index }}" data-modal-toggle="parfum-{{ $index }}"
                                    title="Edit">
                                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <a href="{{ route('admProduk.destroy', $parfum->id) }}" title="Hapus Parfum"
                                    class="p-1 rounded bg-red-600 hover:bg-red-700" data-confirm-delete="true">
                                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
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
                            <select name="kategori" id="kategori" class="block w-full text-sm rounded border-gray-300 "
                                required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                <option value="pria" {{ old('kategori') == 'pria' ? 'selected' : '' }}>Pria</option>
                                <option value="wanita" {{ old('kategori') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="font-medium text-sm">Nama Parfum<span
                                    class="text-red-600">*</span></label>
                            <input type="text" class="rounded w-full border-gray-300 text-sm" name="nama"
                                value="{{ old('nama') }}" placeholder="Cth: Sauvage Dior" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="font-medium text-sm">Harga<span
                                    class="text-red-600">*</span></label>
                            <input type="number" min="1" class="rounded w-full border-gray-300 text-sm" min="1" name="harga"
                                value="{{ old('harga') }}" placeholder="Cth: 25000" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="font-medium text-sm">Deskripsi<span
                                    class="text-red-600">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" rows="5"
                                class="block w-full text-sm rounded border-gray-300 " placeholder="Deskripsi parfum..."
                                required>{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="font-medium text-sm">Gambar Parfum<span
                                    class="text-red-600">*</span></label>
                            <input type="file" accept="image/*" class="rounded w-full ring-gray-300 text-sm ring-1"
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
                                    <select name="kategori" id="kategori" class="block w-full text-sm rounded border-gray-300 "
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
                                    <input type="text" class="rounded w-full border-gray-300 text-sm" name="nama"
                                        value="{{ old('nama', $edit->nama) }}" placeholder="Cth: Sauvage Dior" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="font-medium text-sm">Harga<span
                                            class="text-red-600">*</span></label>
                                    <input type="number" min="1" class="rounded w-full border-gray-300 text-sm" min="1" name="harga"
                                        value="{{ old('harga', $edit->harga) }}" placeholder="Cth: 25000" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="font-medium text-sm">Deskripsi<span
                                            class="text-red-600">*</span></label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4"
                                        class="block w-full text-sm rounded border-gray-300 " placeholder="Deskripsi parfum..."
                                        required>{{ old('deskripsi', $edit->deskripsi) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="font-medium text-sm">Gambar Parfum<span
                                            class="text-gray-400 italic">(Opsional)</span></label>
                                    <input type="file" accept="image/*" class="rounded w-full ring-gray-300 text-sm ring-1"
                                        name="gambar">
                                </div>
                                <button type="submit"
                                    class="w-full text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambahkan
                                    Parfum</button>
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
                                    <input type="number" class="rounded w-full border-gray-300 text-sm" min="1" name="harga_diskon"
                                        value="{{ old('harga_diskon', $diskon->harga_diskon) }}" placeholder="Cth: 50000"
                                        required>
                                </div>
                                <hr class="py-2">
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