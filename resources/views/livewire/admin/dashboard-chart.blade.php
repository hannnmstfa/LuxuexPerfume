<div class="max-w-screen-xl w-full bg-white border rounded shadow p-4 md:p-6 mt-5 relative">
    <div class="flex justify-between items-start">
        <div>
            <h5 class="text-2xl font-semibold text-heading">{{ $chartData->count() }} Transaksi</h5>
            <p class="text-body">Rp{{ number_format($chartData->sum('total_harga')) }}</p>
        </div>
        <input type="month" wire:model.live="bulan" id="bulan" class="rounded-lg border-gray-300" />
    </div>
    <div id="area-chart"></div>
    <div class="grid grid-cols-1 items-center border-light border-t justify-between">
        <div class="flex justify-between items-center pt-4 md:pt-6">
            <!-- Button -->
            <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown" data-dropdown-placement="bottom"
                class="text-sm font-medium text-body hover:text-heading text-center inline-flex items-center"
                type="button">
                Last 7 days
                <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 9-7 7-7-7" />
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="lastDaysdropdown"
                class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#"
                            class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Yesterday</a>
                    </li>
                    <li>
                        <a href="#"
                            class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Today</a>
                    </li>
                    <li>
                        <a href="#"
                            class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last
                            7 days</a>
                    </li>
                    <li>
                        <a href="#"
                            class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last
                            30 days</a>
                    </li>
                    <li>
                        <a href="#"
                            class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Last
                            90 days</a>
                    </li>
                </ul>
            </div>
            <a href="#"
                class="inline-flex items-center text-fg-brand bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm px-3 py-2 focus:outline-none">
                Users Report
                <svg class="w-4 h-4 ms-1.5 -me-0.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
            </a>
        </div>
    </div>
    <div wire:loading.remove.class="hidden" wire:loading.class="flex"
        wire:target="bulan()"
        class="absolute w-full top-0 left-0 right-0 bottom-0 bg-gray-500 hidden justify-center items-center bg-opacity-50 rounded-lg">
        <x-loader />
    </div>

    <script>
        const brandColor = "#9f580a";
        const options = {
            chart: {
                height: "100%",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: brandColor,
                    gradientToColors: [brandColor],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: 0
                },
            },
            series: [
                {
                    name: "Jumlah Transaksi",
                    data: @json($jumlah_trx),
                    color: brandColor,
                },
            ],
            xaxis: {
                categories: @json($tanggal),
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
        }

        document.addEventListener('DOMContentLoaded', function () {
            const chart = new ApexCharts(document.getElementById("area-chart"), options);
            chart.render();
        });

    </script>
</div>