<div class="w-full bg-gray-50 dark:bg-black/70 dark:backdrop-blur border dark:border-gray-700 rounded shadow p-4 md:p-6 mt-5 relative">
    <div class="flex justify-between items-start dark:text-white">
        <div>
            <h5 class="text-2xl font-semibold text-heading">Rp{{ number_format($chartData->sum('total_harga')) }}</h5>
            <div class="flex justify-start items-center gap-1">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16.881 16H7.119a1 1 0 0 1-.772-1.636l4.881-5.927a1 1 0 0 1 1.544 0l4.88 5.927a1 1 0 0 1-.77 1.636Z" />
                </svg>
                <span class="text-body">{{ $chartData->count() }} Transaksi</span>
            </div>
        </div>
        <input type="month" wire:model.live="bulan" id="bulan" class="rounded-lg border-gray-300 dark:bg-gray-800 text-gray-900 dark:text-white" />
    </div>
    <div id="area-chart" class="!text-black" wire:ignore></div>
    <div class="grid grid-cols-1 items-center border-light border-t justify-between dark:text-white">
        <div class="flex justify-end items-center pt-4 md:pt-6">
            <a href="{{ route('admLaporan.index') }}"
                class="inline-flex items-center text-fg-brand bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm px-3 py-2 focus:outline-none">
                Laporan Bulanan
                <svg class="w-4 h-4 ms-1.5 -me-0.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
            </a>
        </div>
    </div>
    <div wire:loading.remove.class="hidden" wire:loading.class="flex" wire:target="bulan()"
        class="absolute w-full top-0 left-0 right-0 bottom-0 bg-gray-500 hidden justify-center items-center bg-opacity-50 rounded">
        <x-loader />
    </div>

    <script>
        
        let chart;
        const brandColor = "#9f580a";

        function initChart(tanggal, jumlah_trx) {
            const options = {
                chart: {
                    height: "100%",
                    maxWidth: "100%",
                    type: "area",
                    fontFamily: "Inter, sans-serif",
                    toolbar: { show: false },
                    dropShadow: { enabled: false },
                },
                tooltip: { enabled: true, x: { show: false } },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: brandColor,
                        gradientToColors: [brandColor],
                    },
                },
                dataLabels: { enabled: false },
                stroke: { width: 6 },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: { left: 2, right: 2, top: 0 },
                },
                series: [{ name: "Jumlah Transaksi", data: jumlah_trx, color: brandColor }],
                xaxis: {
                    categories: tanggal,
                    labels: { show: false },
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                },
                yaxis: { show: false },
            };

            chart = new ApexCharts(document.querySelector("#area-chart"), options);
            chart.render();
        }

        document.addEventListener('livewire:init', () => {
            // init pertama kali dari data awal blade
            const tanggalAwal = @json($tanggal);
            const trxAwal = @json($jumlah_trx);
            initChart(tanggalAwal, trxAwal);

            // LISTEN event dari PHP: $this->dispatch('updateChart', ...)
            window.addEventListener('updateChart', (e) => {
                const [tanggal, jumlah_trx] = e.detail;

                if (!chart) return;

                chart.updateOptions({
                    xaxis: { categories: tanggal }
                }, false, true);

                chart.updateSeries([{
                    name: "Jumlah Transaksi",
                    data: jumlah_trx,
                    color: brandColor
                }], true);
            });
        });
    </script>
</div>