<x-app-layout title="Kelola Toko">
    <div
        class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Kelola Informasi Toko</h5>
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
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Kelola
                                Toko</span>
                        </div>
                    </li>
                </ol>
            </div>
            <button type="button" id="btnEdit"
                class="bg-gold py-1 px-4 rounded-lg text-black font-semibold flex justify-center items-center gap-2 hover:opacity-80">
                <svg class="w-5 h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                </svg>
                <span>Edit</span>
            </button>
        </div>
    </div>
    <div id="viewToko">
        <div
            class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur border dark:border-gray-700 p-5 mt-5">
            <div class="grid grid-cols-12 gap-4">
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
                </div>
                <div class="col-span-12 md:col-span-9">
                    <div class="mb-4">
                        <label for="nama" class="font-semibold text-lg">Nama Toko</label>
                        <input type="text"
                            class="rounded w-full border-gray-300 text-sm  dark:bg-gray-800 dark:border-gray-500 dark:text-gray-400 mt-2"
                            name="nama" value="{{ $toko->nama_toko ?? 'Nama toko belum diatur' }}"
                            placeholder="Cth: Toko Parfum Luxuex" disabled>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="email" class="font-semibold text-lg">Email Toko</label>
                            <input type="text"
                            class="rounded w-full border-gray-300 text-sm  dark:bg-gray-800 dark:border-gray-500 dark:text-gray-400 mt-2"
                            name="email" value="{{ $toko->email_toko ?? 'Email toko belum diatur' }}"
                            placeholder="Cth: Toko Parfum Luxuex" disabled>
                        </div>
                        <div>
                            <label for="phone" class="font-semibold text-lg">Telepon Toko</label>
                            <input type="text"
                            class="rounded w-full border-gray-300 text-sm  dark:bg-gray-800 dark:border-gray-500 dark:text-gray-400 mt-2"
                            name="phone" value="{{ $toko->phone_toko ?? 'No telepon toko belum diatur' }}"
                            placeholder="Cth: Toko Parfum Luxuex" disabled>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="font-semibold text-lg">Alamat Toko</label>
                        <textarea name="alamat" rows="5" id="alamat" class="rounded w-full border-gray-300 text-sm  dark:bg-gray-800 dark:border-gray-500 dark:text-gray-400 mt-2" disabled>{{ $toko->alamat_toko ?? 'Alamat toko belum diatur' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="editToko" class="hidden">
        <livewire:admin.kelola-toko />
    </div>
</x-app-layout>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        const btnEdit = document.querySelector('#btnEdit');
        const viewToko = document.querySelector('#viewToko');
        const editToko = document.querySelector('#editToko');

        btnEdit.addEventListener('click', function () {
            viewToko.classList.add('hidden');
            editToko.classList.remove('hidden');
            btnEdit.classList.add('hidden');
        });
    });
</script>