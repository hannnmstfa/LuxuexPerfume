<x-mail::message>
    Transaksi <strong>#{{ $data->transaksi->kodeTrx }}</strong>
    <hr class="my-2">
    Halo Admin, Pengguna <strong>{{ $data->transaksi->users->email }}</strong> telah mengajukan
    <strong>{{ ucwords($data->type) }}</strong> dengan alasan:<br>
    <small class="!text-justify italic !font-inter">{{ $data->deskripsi }}</small>
    <hr class="my-2">
    Detail pengembalian dapat dilihat pada tombol berikut:
    <center class="mt-4">
        <a target="_blank" href="{{ route('admReturn.show', $data->transaksi->kodeTrx) }}"
            class="bg-gold py-1 px-3 rounded-lg !text-gray-800 font-bold hover:opacity-80">Detail Pengembalian</a>
    </center>
    <br>
    Atau jika tombol tidak berfungsi:<br>
    <a target="_blank" href="{{ route('admReturn.show', $data->transaksi->kodeTrx) }}"
        class="italic underline"><small>{{ route('admReturn.show', $data->transaksi->kodeTrx) }}</small></a>
    <br><br>
    Thanks,<br>
    {{ \App\Models\TokoSetting::data()->nama_toko ?? config('app.name', 'Laravel') }}
</x-mail::message>