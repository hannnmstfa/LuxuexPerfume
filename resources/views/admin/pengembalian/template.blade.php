<x-app-layout title="Template Catatan Pengembalian">
    <div
        class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Kelola Catatan Pengembalian</h5>
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
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('admReturn.index') }}"
                                class="ms-1 text-sm font-medium hover:text-blue-600 text-gray-500 md:ms-2">Pengembalian</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-[600] text-gold md:ms-2">Template</span>
                        </div>
                    </li>
                </ol>
            </div>
            <button data-modal-target="catatan" data-modal-toggle="catatan"
                class="flex items-center justify-center px-4 py-2 text-sm font-semibold text-white rounded-lg bg-yellow-700 dark:bg-gold dark:text-black hover:opacity-85">
                <svg class="w-5 h-5 mr-2 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Catatan
            </button>
        </div>
    </div>
    <div
        class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur border dark:border-gray-700 p-3 mt-5">
        <x-loader />
        <table id="myTable" class="hidden w-full text-sm text-center dark:text-gray-400">
            <thead>
                <tr class="">
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black text-left">
                        No
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black text-left">
                        Nama Template
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black text-left">
                        Konten
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black text-left">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $i => $data)
                    <tr
                        class="odd:bg-gray-50 even:bg-gray-200 dark:odd:bg-gray-800/40 dark:even:bg-gray-700/40 dark:backdrop-blur">
                        <td class="px-6 py-4">{{ $i + 1 }}</td>
                        <td class="px-6 py-4">{{ $data->nama }}</td>
                        <td class="px-6 py-4">{{ Str::limit(strip_tags($data->konten), 75) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-start items-center gap-2 text-gold">
                                <button class="hover:opacity-85 btnEdit" data-modal-target="catatanEdit" data-modal-toggle="catatanEdit" data-nama="{{ $data->nama }}"
                                    data-konten="{{ $data->konten }}"
                                    data-route="{{ route('noteReturn.update', $data->id) }}">Edit</button>
                                <span class="text-gray-500">|</span>
                                <a href="{{ route('noteReturn.destroy', $data->id) }}" data-confirm-delete="true"
                                    class="hover:opacity-85">Hapus</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div id="catatan" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full scroll-style">
        <div class="relative p-4 w-full max-w-screen-lg max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 pb-0 md:pb-0 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Catatan Pengembalian
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="catatan">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 text-sm">
                    <form id="formAdd" action="{{ route('noteReturn.store') }}" class=" border-t border-gray-600 pt-4"
                        method="post">
                        @csrf
                        <div class="mb-4">
                            <p class="font-semibold mb-2">Nama Template<span class="text-red-500">*</span></p>
                            <input type="text"
                                class="rounded w-full border-gray-300 text-sm  dark:bg-gray-900 dark:border-gray-500"
                                name="nama" value="{{ old('nama') }}" placeholder="Nama catatan pengembalian" required>
                        </div>
                        <div class="mb-4">
                            <p class="font-semibold mb-2">Konten<span class="text-red-500">*</span></p>
                            <x-quill-editor id="kontenAdd" name="konten" :value="old('konten')" />
                        </div>
                        <div class="flex items-center justify-end border-t border-gray-600 space-x-4 pt-4">
                            <button data-modal-hide="catatan" type="button"
                                class="text-white bg-gray-900 rounded-lg border border-gray-600 shadow-xs text-sm px-4 py-2.5 hover:opacity-85">Batal</button>
                            <button type="submit"
                                class="text-black rounded-lg font-bold bg-gold border border-gray-600 shadow text-sm px-4 py-2.5 hover:opacity-85">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="catatanEdit" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full scroll-style">
        <div class="relative p-4 w-full max-w-screen-lg max-h-full scroll-style">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 pb-0 md:pb-0 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Catatan Pengembalian
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="catatanEdit">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 text-sm">
                    <form id="formEdit" class=" border-t border-gray-600 pt-4" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <p class="font-semibold mb-2">Nama Template<span class="text-red-500">*</span></p>
                            <input type="text" id="namaEdit"
                                class="rounded w-full border-gray-300 text-sm  dark:bg-gray-900 dark:border-gray-500"
                                name="namaEdit" value="{{ old('namaEdit') }}" placeholder="Nama catatan pengembalian" required>
                        </div>
                        <div class="mb-4">
                            <p class="font-semibold mb-2">Konten<span class="text-red-500">*</span></p>
                            <x-quill-editor id="kontenEdit" name="kontenEdit" :value="old('kontenEdit')" />
                        </div>
                        <div class="flex items-center justify-end border-t border-gray-600 space-x-4 pt-4">
                            <button data-modal-hide="catatanEdit" type="button"
                                class="text-white bg-gray-900 rounded-lg border border-gray-600 shadow-xs text-sm px-4 py-2.5 hover:opacity-85">Batal</button>
                            <button type="submit"
                                class="text-black rounded-lg font-bold bg-gold border border-gray-600 shadow text-sm px-4 py-2.5 hover:opacity-85">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-simple-datatables />
<script>
    document.addEventListener('click', function (e) {

        const btn = e.target.closest('.btnEdit');

        if (!btn) return;

        const nama = btn.dataset.nama;
        const konten = btn.dataset.konten;
        const route = btn.dataset.route;

        document.getElementById('namaEdit').value = nama;

        const quill = window.quillEditors['kontenEdit'];

        quill.setContents([]);

        quill.clipboard.dangerouslyPasteHTML(konten);

        document.getElementById('formEdit').action = route;

    });
</script>