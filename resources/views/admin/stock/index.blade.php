<x-app-layout title="Kelola Stok">
    <div class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-gray-800 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Kelola Stok Parfum</h5>
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
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Stok</span>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="rounded-lg shadow-lg bg-gray-100 p-3 mt-5 border">
        <x-loader />
        <table id="myTable" class="hidden w-full text-sm dark:text-gray-400">
            <thead>
                <th scope="col" class=" bg-gray-200 dark:bg-gray-500">No</th>
                <th scope="col" class=" bg-gray-200 dark:bg-gray-500">Parfum</th>
                <th scope="col" class=" bg-gray-200 dark:bg-gray-500">Jumlah</th>
                <th scope="col" class=" bg-gray-200 dark:bg-gray-500">Aksi</th>
            </thead>
            <tbody>
                @foreach ($data as $index => $stok)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $stok->produks->nama . ' (' . ucfirst($stok->produks->kategori) . ')'}}</td>
                        <td>{{ number_format($stok->jumlah) }}</td>
                        <td>
                            <button class="bg-yellow-400 hover:bg-yellow-500 rounded p-1"
                                data-modal-target="stok-{{ $index }}" data-modal-toggle="stok-{{ $index }}"
                                title="Atur Stok">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Stok -->
    @if ($data->isNotEmpty())
        @foreach ($data as $no => $edit)
            <div id="stok-{{ $no }}" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Atur Stok Parfum
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="stok-{{ $no }}">
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
                            <form action="{{ route('admStock.update', $edit->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="jumlah" class="font-medium text-sm">Jumlah<span
                                            class="text-red-600">*</span></label>
                                    <input type="number" class="rounded w-full border-gray-300 text-sm"  name="jumlah"
                                        value="{{ old('jumlah', $edit->jumlah) }}" placeholder="Cth: 50" required>
                                </div>
                                <hr class="py-2">
                                <button type="submit"
                                    class="w-full text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Perubahan</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</x-app-layout>
<x-simple-datatables />