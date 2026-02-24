<div class="w-full">
    <div class="relative overflow-hidden bg-gray-100 shadow-md dark:bg-gray-800 rounded-lg border">
        <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
                <h5 class="mr-3 text-xl font-semibold dark:text-white">Laporan Bulanan</h5>
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
                                class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Laporan</span>
                        </div>
                    </li>
                </ol>
            </div>
            <input type="month" wire:model.live="bulan"
                class="rounded-lg border-gray-300 focus:ring-yellow-500 focus:border-yellow-500 block sm:text-sm">
        </div>
    </div>
    <div class="rounded-lg shadow-lg bg-gray-100 p-3 mt-5 border" wire:key="laporan-{{ $bulan }}"
        wire:loading.class="opacity-50">
        <div
            class="flex justify-end items-center gap-2 text-sm font-semibold {{ $laporans->isEmpty() ? 'hidden' : '' }}">
            <button type="button" id="btnCsv" class="px-2 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded">
                Export CSV
            </button>
            <a target="_blank" href="{{ route('admLaporan.pdf', $bulan) }}"
                class="px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded">
                Export PDF
            </a>
        </div>
        <table id="myTable" class="hidden w-full text-sm text-center dark:text-gray-400 overflow-auto">
            <thead>
                <tr class="">
                    <th scope="col" class="bg-yellow-500 text-white text-center w-max">
                        No
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Tgl Transaksi
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Kode Transaksi
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Customer
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Produk Dibeli
                    </th>
                    <th scope="col" class="bg-yellow-500 text-white">
                        Subtotal
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans as $data)
                    <tr class="border-b border-gray-400 odd:bg-white even:bg-gray-200 relative">
                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $data->created_at->isoFormat('DD-MM-YYYY') }}</td>
                        <td class="px-6 py-4 font-bold">{{ $data->kodeTrx }}</td>
                        <td class="px-6 py-4">
                            <p class="text-gray-900 text-nowrap">{{ $data->users->name }}</p>
                            <p class="text-xs text-gray-500">{{ $data->users->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <ul class="list-disc">
                                @foreach ($data->transaksi_items as $item)
                                    <li class="text-nowrap">{{ $item->produks->nama }} (x{{ $item->jumlah }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="px-6 py-4">Rp {{ number_format($data->total_harga) }}</td>
                    </tr>
                @endforeach
                @if ($laporans->isNotEmpty())
                    <tr class="font-bold">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">Total</td>
                        <td class="px-6 py-4">Rp{{ number_format($laporans->sum('total_harga')) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener('livewire:init', () => {
            let dt;

            function initTable() {
                const el = document.querySelector('#myTable');
                if (!el) return;

                if (dt) {
                    dt.destroy();
                    dt = null;
                }

                dt = new simpleDatatables.DataTable(el, {
                    paging: false,
                    perPage: false,
                    searchable: false,
                    sortable: true,
                    numeric: true,
                    labels: {
                        placeholder: "Cari data...",
                        searchTitle: "Cari data di tabel",
                        pageTitle: "Halaman {page}",
                        perPage: "",
                        noRows: "Belum ada data",
                        info: "Menampilkan {start} sampai {end} dari {rows} data",
                        noResults: "Tidak ditemukan data yang sama",
                    },
                });
                // CSV
                document.getElementById('btnCsv')?.addEventListener('click', () => {
                    const bulan = document.querySelector('input[type="month"]').value;
                    simpleDatatables.exportCSV(dt, {
                        download: true,
                        lineDelimiter: "\n",
                        columnDelimiter: ";",
                        filename: "laporan-" + bulan
                    });
                });
                setTimeout(() => {
                    el.classList.remove('hidden');
                }, 100);
            }

            // INIT setelah Livewire selesai render/mount/update
            if (window.Livewire.hook) {
                // Livewire v2
                Livewire.hook('morph.finished', () => {
                    initTable();
                });
            } else {
                // Fallback: Livewire v3
                Livewire.on('commit', () => {
                    initTable();
                });
            }

            // Kalau bulan berubah (event dari Livewire)
            Livewire.on('datatable:reload', () => {
                setTimeout(initTable, 50);
            });
        });
    </script>
</div>