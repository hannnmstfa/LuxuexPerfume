<x-app-layout title="Daftar Transaksi">
    <div class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-gray-800 rounded-lg border">
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
    <div class="rounded-lg shadow-lg bg-gray-100 p-3 mt-5 border">
        <x-loader />
        <table id="myTable" class="hidden w-full text-sm text-center dark:text-gray-400 overflow-auto">
            <thead>
                <tr class="">
                    <th scope="col" class="bg-yellow-500 text-white text-center w-max">
                        No
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Kode Transaksi
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Customer
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Waktu Transaksi
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Status Bayar
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Total Bayar
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Status Pengiriman
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr class="border-b border-gray-400 odd:bg-white even:bg-gray-200 relative">
                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-bold">{{ $data->kodeTrx }}</td>
                        <td class="px-6 py-4">
                            <p class="text-gray-900 text-nowrap">{{ $data->users->name }}</p>
                            <p class="text-xs text-gray-500">{{ $data->users->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-nowrap text-gray-800">{{ $data->created_at->isoFormat('dddd, D MMM YYYY') }}</p>
                            <p class="text-xs text-gray-500">{{ $data->created_at->isoFormat('HH:mm') }} WIB</p>
                        </td>
                        <td class="px-6 py-4">
                            @if ($data->status_bayar == 'berhasil')
                                <span
                                    class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full dark:bg-green-900 dark:text-green-300">
                                    BERHASIL
                                </span>
                            @else
                                <span
                                    class="px-2 py-1 text-xs font-semibold text-nowrap {{ $data->status_bayar == 'kadaluarsa' ? 'bg-gray-500 text-white' : '' }} {{ $data->status_bayar == 'menunggu pembayaran' ? 'text-yellow-800 bg-yellow-200' : '' }} {{ $data->status_bayar == 'gagal' ? 'text-red-800 bg-red-200' : '' }} rounded-full">
                                    {{ strtoupper($data->status_bayar) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">Rp {{ number_format($data->total_harga + $data->fee_payment) }}</td>
                        <td>
                            @if($data->status_bayar !== 'berhasil')
                                <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-300 rounded-full">
                                    -
                                </span>
                            @else
                                @if (!$data->trackings || !$data->trackings->resi)
                                    <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full text-nowrap">No.Resi Belum Ada</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-nowrap {{ $data->trackings->status == 'pengiriman selesai' ? 'text-green-800 bg-green-200' : 'text-yellow-800 bg-yellow-200' }} rounded-full">{{ ucwords($data->trackings->status) }}</span>
                                @endif
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admTrx.show', $data->kodeTrx) }}" class="py-1 px-3 bg-sky-500 hover:bg-sky-600 rounded font-semibold text-white">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
<x-simple-datatables />