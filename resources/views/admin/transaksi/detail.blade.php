<x-app-layout title="Detail Transaksi {{ $trx->kodeTrx }}">
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Detail Transaksi</h2>
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Informasi Transaksi</h3>
                <p><strong>Kode Transaksi:</strong> {{ $trx->kodeTrx }}</p>
                <p><strong>Customer:</strong> {{ $trx->users->name }}</p>
                <p><strong>Total Bayar:</strong> Rp {{ number_format($trx->total_harga + $trx->fee_payment) }}</p>
            </div>
        </div>
    </div>

</x-app-layout>