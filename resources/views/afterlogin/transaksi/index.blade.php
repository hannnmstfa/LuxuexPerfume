<x-guest-layout title="Riwayat Transaksi">
    <div class="flex flex-col justify-center items-center py-9 bg-gray-300 shadow-inner">
        <div class="inline-flex justify-center items-center gap-1">
            <a href="{{ route('/') }}" class="text-xs hover:text-yellow-600 hover:underline">
                Home
            </a>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 9-7 7-7-7" />
            </svg>
        </div>
        <h2 class="font-inter text-2xl md:text-3xl font-semibold">RIWAYAT TRANSAKSI</h2>
    </div>
    <div class="max-w-screen-xl mx-auto p-3">
        <div class="overflow-auto">
            <table id="myTable" class="hidden font-inter">
                <thead>
                    <tr>
                        <th class="bg-gray-200">Kode Transaksi</th>
                        <th class="bg-gray-200">Waktu Transaksi</th>
                        <th class="bg-gray-200">Metode Pembayaran</th>
                        <th class="bg-gray-200">Total Bayar</th>
                        <th class="bg-gray-200">Status Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>
                                <a href="{{ route('trx.show', $data->kodeTrx) }}"
                                    class="font-bold text-yellow-700 underline">{{ $data->kodeTrx }}</a>
                            </td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('ddd, DD MMMM YYYY') }}</div>
                                <div class="text-xs italic text-gray-400">
                                    {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('HH:mm') }} WIB
                                </div>
                            </td>
                            <td>{{ $data->metode_bayar }}</td>
                            <td>Rp{{ number_format($data->total_harga + $data->fee_payment) }}</td>
                            <td>
                                @if ($data->status_bayar == 'berhasil')
                                    <button
                                        class="border rounded-full py-1 px-3 text-sm font-semibold shadow {{ $data->trackings->status == 'pengiriman selesai' ? 'bg-green-200 text-green-900 border-green-300' : 'bg-yellow-200 text-yellow-900 border-yellow-300'}}">{{ ucwords($data->trackings->status) }}</button>
                                @else
                                    <button
                                        class="border rounded-full py-1 px-3 text-sm font-semibold shadow bg-gray-200 border-gray-300 {{ $data->status_bayar == 'gagal' ? 'bg-red-200 text-red-600 border-red-300' : ($data->status_bayar == 'menunggu pembayaran' ? 'bg-yellow-200 text-yellow-600 border-yellow-300' : '')}}">{{ ucwords($data->status_bayar) }}</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-loader />
    </div>
</x-guest-layout>
<x-simple-datatables />