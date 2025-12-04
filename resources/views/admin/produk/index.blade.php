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
        <table id="myTable" class="hidden w-full text-sm text-left rtl:text-right dark:text-gray-400">
            <thead>
                <tr>
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500 ">
                        No
                    </th>
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500 ">
                        Image
                    </th>
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500 ">
                        Nama
                    </th>
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500 ">
                        Deskripsi
                    </th>
                    <th scope="col" class="bg-gray-200 dark:bg-gray-500 ">
                        Aksi
                    </th>
                </tr>
            </thead>
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
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
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
                            <input type="number" min="1" class="rounded w-full border-gray-300 text-sm" name="harga"
                                value="{{ old('harga') }}" placeholder="Cth: 25000" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="font-medium text-sm">Deskripsi<span
                                    class="text-red-600">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" cols="5"
                                class="block w-full text-sm rounded border-gray-300 " placeholder="Deskripsi parfum..."
                                required>{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="font-medium text-sm">Gambar Parfum<span
                                    class="text-red-600">*</span></label>
                            <input type="file" class="rounded w-full ring-gray-300 text-sm ring-1" name="gambar"
                                value="{{ old('gambar') }}" placeholder="Cth: 25000" required>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambahkan
                            Parfum</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-simple-datatables />