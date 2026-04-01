<x-app-layout title="Pengguna Nonaktif">
    <div
        class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Kelola Pengguna Nonaktif</h5>
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
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Users</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span
                                class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Nonaktif</span>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div
        class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur border dark:border-gray-700 p-3 mt-5">
        <x-loader />
        <table id="myTable" class="hidden w-full text-sm text-center dark:text-gray-400">
            <thead>
                <tr class="">
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold text-center">
                        No
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold">
                        Customer
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold">
                        Info
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold">
                        Jumlah Transaksi
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $data)
                    <tr
                        class="odd:bg-gray-50 even:bg-gray-200 dark:odd:bg-gray-800/40 dark:even:bg-gray-700/40 dark:backdrop-blur relative">
                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <p class="text-gray-900 dark:text-white text-nowrap">{{ $data->name ?? 'deleted user' }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $data->email ?? 'deleted user' }}</p>
                            <p class="text-xs text-gray-500">{{ $data->phone ?? 'deleted user' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs text-gray-900 dark:text-gray-500 text-nowrap">Registered: <span
                                    class="font-semibold dark:text-white">{{ $data->created_at  }}</span></p>
                            <p class="text-xs text-gray-900 dark:text-gray-500 text-nowrap">Deleted: <span
                                    class="font-semibold dark:text-white">{{ $data->deleted_at ?? '-' }}</span></p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-gray-900 dark:text-white text-nowrap">
                                Rp{{ number_format($data->transaksi_sukses->sum('total_harga')) }}</p>
                            <p class="text-xs text-gray-500">{{ $data->transaksi_sukses->count() }} Transaksi</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-start justify-start gap-1">
                                <a href="{{ route('users.restore', $data->id) }}" data-confirm="true" data-icon="question"
                                    data-caption="Apakah anda yakin ingin memulihkan {{ $data->email }}?"
                                    class="flex justify-center items-center gap-1 border rounded-md py-1 px-2 text-xs bg-green-200 text-green-700 font-semibold border-green-500 hover:opacity-85">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3M3.22302 14C4.13247 18.008 7.71683 21 12 21c4.9706 0 9-4.0294 9-9 0-4.97056-4.0294-9-9-9-3.72916 0-6.92858 2.26806-8.29409 5.5M7 9H3V5" />
                                    </svg>
                                    <span>Pulihkan</span>
                                </a>
                                <a href="{{ route('users.forceDestroy', $data->id) }}" data-confirm-delete2="true"
                                    data-caption="Apakah anda yakin ingin menghapus permanen {{ $data->email }}?"
                                    class="flex justify-center items-center gap-1 border rounded-md py-1 px-2 text-xs bg-red-200 text-red-700 font-semibold border-red-500 hover:opacity-85">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Hapus Permanen</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
<x-simple-datatables />