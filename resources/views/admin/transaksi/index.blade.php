<x-app-layout title="Daftar Transaksi">
    <div
        class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Kelola Transaksi</h5>
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
                                class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Transaksi</span>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div
        class="rounded-lg shadow-lg bg-gray-100 dark:bg-black/50 dark:backdrop-blur dark:border-gray-700 p-3 mt-5 border">
        <x-loader />
        <table id="myTable" class="hidden w-full text-sm text-center dark:text-gray-400 overflow-auto scroll-style">
            <thead>
                <tr class="">
                    <th scope="col" class="bg-yellow-500 dark:bg-gold text-white dark:text-black text-center w-max">
                        No
                    </th>
                    <th scope="col" class="bg-yellow-500 dark:bg-gold text-white dark:text-black">
                        Kode Transaksi
                    </th>
                    <th scope="col" class="bg-yellow-500 dark:bg-gold text-white dark:text-black">
                        Customer
                    </th>
                    <th scope="col" class="bg-yellow-500 dark:bg-gold text-white dark:text-black">
                        Waktu Transaksi
                    </th>
                    <th scope="col" class="bg-yellow-500 dark:bg-gold text-white dark:text-black">
                        Status
                    </th>
                    <th scope="col" class="bg-yellow-500 dark:bg-gold text-white dark:text-black">
                        Total Bayar
                    </th>
                    <th scope="col" class="bg-yellow-500 dark:bg-gold text-white dark:text-black">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr
                        class="odd:bg-gray-50 even:bg-gray-200 dark:odd:bg-gray-800/40 dark:even:bg-gray-700/40 dark:backdrop-blur relative">
                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-bold">{{ $data->kodeTrx }}</td>
                        <td class="px-6 py-4">
                            <p class="text-gray-900 dark:text-white text-nowrap">{{ $data->users->name ?? 'deleted user' }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $data->users->email ?? 'deleted user' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-nowrap text-gray-800 dark:text-white">
                                {{ $data->created_at->isoFormat('dddd, D MMM YYYY') }}</p>
                            <p class="text-xs text-gray-500">{{ $data->created_at->isoFormat('HH:mm') }} WIB</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($data->is_success)
                                <button
                                    class="border rounded-full w-max py-1 px-3 text-nowrap text-xs font-semibold shadow bg-blue-200 text-blue-700 border-blue-300 ">Transaksi
                                    Selesai</button>
                            @elseif ($data->status_bayar == 'berhasil')
                                @if ($data->pengembalian)
                                    <button
                                        class="border rounded-full w-max py-1 px-3 text-nowrap text-xs font-semibold shadow bg-yellow-200 text-yellow-600 border-yellow-300 {{ $data->pengembalian->status == 'disetujui' ? '!bg-green-200 !text-green-900 !border-green-300' : ($data->pengembalian->status == 'ditinjau' ? '' : '!text-red-600 !bg-red-200 !border-red-300')}}">{{ ucwords('Pengembalian ' . $data->pengembalian->status) }}</button>
                                @else
                                    <button
                                        class="border rounded-full w-max py-1 px-3 text-nowrap text-xs font-semibold shadow bg-yellow-200 text-black border-yellow-300 {{ $data->trackings && $data->trackings->status == 'pengiriman selesai' ? '!bg-green-200 !text-green-900 !border-green-300' : '!text-black'}}">{{ ucwords($data->trackings->status ?? 'Sedang diproses') }}</button>
                                @endif
                            @else
                                <button
                                    class="border rounded-full py-1 px-3 text-nowrap text-gray-400 text-xs font-semibold shadow  border-gray-500 {{ $data->status_bayar == 'gagal' ? ' text-red-600 border-red-600' : ($data->status_bayar == 'menunggu pembayaran' ? ' text-yellow-600 border-yellow-600' : ($data->status_bayar == 'refund' ? 'text-sky-600 border-sky-600' : ''))}}">{{ ucwords($data->status_bayar) }}</button>
                            @endif
                        </td>
                        <td class="px-6 py-4">Rp {{ number_format($data->total_harga + $data->fee_payment) }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admTrx.show', $data->kodeTrx) }}"
                                class="py-1 px-3 bg-sky-500 hover:bg-sky-600 rounded font-semibold text-white">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
<x-simple-datatables />