<x-mail::message>
Transaksi <strong>#{{ $trx->kodeTrx }}</strong>

Ada pesanan baru dari <strong>{{ $trx->users->email }}</strong> dengan total bayar
<strong>Rp{{ number_format($trx->total_harga + $trx->fee_payment) }}</strong>. Silahkan segera proses pesanan
tersebut.

<x-mail::button :url="route('admTrx.show', $trx->kodeTrx)">
Lihat Pesanan
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>