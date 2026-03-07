<x-guest-layout title="Riwayat Transaksi">
    <section class="reveal border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-10 md:py-12 text-center">
            <h1 class="text-3xl md:text-4xl font-semibold tracking-tight">
                RIWAYAT <span class="text-[#D4AF37]">TRANSAKSI</span>
            </h1>
        </div>
    </section>
    <div class="max-w-screen-xl mx-auto p-3">
        <div class="overflow-auto">
            <table id="myTable" class="hidden font-inter">
                <thead>
                    <tr>
                        <th class="bg-gold text-white">Kode Transaksi</th>
                        <th class="bg-gold text-white">Waktu Transaksi</th>
                        <th class="bg-gold text-white">Metode Pembayaran</th>
                        <th class="bg-gold text-white">Total Bayar</th>
                        <th class="bg-gold text-white">Status Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr class="text-white">
                            <td>
                                <a href="{{ route('trx.show', $data->kodeTrx) }}"
                                    class="font-bold text-yellow-500 underline">{{ $data->kodeTrx }}</a>
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
                                        class="border rounded-full py-1 px-3 text-nowrap text-sm font-semibold shadow {{ $data->trackings->status == 'pengiriman selesai' ? 'bg-green-200 text-green-900 border-green-300' : 'bg-yellow-200 text-yellow-900 border-yellow-300'}}">{{ ucwords($data->trackings->status) }}</button>
                                @else
                                    <button
                                        class="border rounded-full py-1 px-3 text-nowrap dark:text-black text-sm font-semibold shadow bg-gray-200 border-gray-300 {{ $data->status_bayar == 'gagal' ? 'bg-red-200 text-red-600 border-red-300' : ($data->status_bayar == 'menunggu pembayaran' ? 'bg-yellow-200 text-yellow-600 border-yellow-300' : '')}}">{{ ucwords($data->status_bayar) }}</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fungsi umum untuk inisialisasi DataTable
        function initDataTable(tableId, loaderSelector) {
            const tableEl = document.getElementById(tableId);
            const loaderEl = document.querySelector(loaderSelector);

            if (tableEl && typeof simpleDatatables.DataTable !== 'undefined') {
                setTimeout(() => {
                    const dataTable = new simpleDatatables.DataTable(tableEl, {
                        paging: false,
                        searchable: true,
                        sortable: true,
                        numeric: true,
                        labels: {
                            placeholder: "Cari transaksi...",
                            searchTitle: "Cari data di tabel",
                            pageTitle: "Halaman {page}",
                            perPage: "",
                            noRows: "Belum ada data",
                            info: "Menampilkan {start} sampai {end} dari {rows} data",
                            noResults: "Tidak ditemukan data yang sama",
                        },
                    });
                    // Fungsi untuk rebind modal Flowbite setiap update/sort/paging
                    const rebindFlowbite = () => {
                        document.querySelectorAll('[data-modal-toggle]').forEach(el => {
                            const newEl = el.cloneNode(true);
                            el.parentNode.replaceChild(newEl, el);
                        });
                        if (typeof window.initFlowbite === 'function') {
                            window.initFlowbite();
                        }
                    };

                    // Jalankan rebind setiap event perubahan tabel
                    dataTable.on('datatable.page', rebindFlowbite);
                    dataTable.on('datatable.update', rebindFlowbite);
                    dataTable.on('datatable.sort', rebindFlowbite);

                    // Sembunyikan loader dan tampilkan tabel
                    if (loaderEl) loaderEl.style.display = "none";
                    tableEl.style.display = "table";

                    rebindFlowbite();
                }, 1000);
            }
        }

        // Inisialisasi kedua tabel
        initDataTable("myTable", "#loader");
        initDataTable("myTable2", "#loader2");
    });
</script>