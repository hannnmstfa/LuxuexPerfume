<x-guest-layout title="Checkout">
<div class="max-w-7xl mx-auto px-4">
  <div class="grid grid-cols-12 gap-6">

    <!-- KIRI -->
    <div class="col-span-12 lg:col-span-8 space-y-6">
        <!-- Card Data Penerima -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="font-semibold mb-4">Data Penerima</h2>
            <!-- form -->
        </div>

        <!-- Card Alamat -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="font-semibold mb-4">Alamat Pengiriman</h2>
        </div>

        <!-- Card Pengiriman -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="font-semibold mb-4">Pengiriman</h2>
        </div>
    </div>

    <!-- KANAN -->
    <div class="col-span-12 lg:col-span-4">
        <div class="sticky top-24 bg-white p-6 rounded shadow">
            <h2 class="font-semibold mb-4">Ringkasan Pesanan</h2>
            <!-- summary -->
            <button class="w-full mt-4 bg-yellow-600 text-white py-3 rounded">
                Bayar Sekarang
            </button>
        </div>
    </div>

  </div>
</div>

</x-guest-layout>