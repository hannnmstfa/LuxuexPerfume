<x-app-layout title="Kelola Pengembalian">
    <div
        class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Kelola Pengembalian Pesanan</h5>
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
                                class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Pengembalian</span>
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
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black text-center">
                        No
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black">
                        Pesanan
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black">
                        Tipe Pengembalian
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black">
                        Status
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white dark:bg-gold dark:text-black">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $i => $data)
                    <tr
                        class="odd:bg-gray-50 even:bg-gray-200 dark:odd:bg-gray-800/40 dark:even:bg-gray-700/40 dark:backdrop-blur">
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td class="font-bold">{{ $data->transaksi->kodeTrx }}</td>
                        <td><span
                                class="text-nowrap border rounded-lg py-1 px-2 text-black font-semibold text-xs {{ $data->type == 'pengembalian dana' ? 'bg-indigo-200' : 'bg-yellow-200' }}">{{ ucwords($data->type) }}</span>
                        </td>
                        <td><span class="text-nowrap border border-gray-800 rounded-lg py-1 px-2 text-black font-semibold text-xs {{ $data->status == 'disetujui' ? 'bg-green-400' : ($data->status == 'ditolak' ? 'bg-red-500' : 'bg-gold') }}">{{ ucwords($data->status) }}</span></td>
                        <td>
                            <a href="{{ route('admReturn.show', $data->transaksi->kodeTrx) }}" class="py-1 px-3 bg-sky-500 hover:bg-sky-600 rounded font-semibold text-white">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
<x-simple-datatables />