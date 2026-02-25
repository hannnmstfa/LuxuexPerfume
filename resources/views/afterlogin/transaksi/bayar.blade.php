<x-guest-layout title="Pembayaran {{ $trx->kodeTrx }}">
    <section class="reveal border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-10 md:py-12 text-center">
            <h1 class="text-3xl md:text-4xl font-semibold text-[#D4AF37] tracking-tight">
                PEMBAYARAN
            </h1>
            <P class="text-xs">Selesaikan pembayaran supaya pesanananmu segera diproses</P>
        </div>
    </section>
    <div class="max-w-screen-xl mx-auto p-4">
        <iframe class="w-full h-[600px] border-0" src="{{ $tripay->checkout_url }}"
            frameborder="0"></iframe>
</x-guest-layout>