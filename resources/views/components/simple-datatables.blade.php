<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fungsi umum untuk inisialisasi DataTable
    function initDataTable(tableId, loaderSelector) {
        const tableEl = document.getElementById(tableId);
        const loaderEl = document.querySelector(loaderSelector);

        if (tableEl && typeof simpleDatatables.DataTable !== 'undefined') {
            setTimeout(() => {
                const dataTable = new simpleDatatables.DataTable(tableEl, {
                    paging: true,
                    perPage: 5,
                    searchable: true,
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
