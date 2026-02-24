<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan {{ $bulan }} - {{ config('app.name') }}</title>

    <style>
        @page {
            margin: 24px 28px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #111;
        }

        .header {
            width: 100%;
            margin-bottom: 14px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo {
            width: 90px;
        }

        .title {
            text-align: right;
        }

        .title h1 {
            margin: 0;
            font-size: 16px;
            line-height: 1.2;
        }

        .title .meta {
            margin-top: 4px;
            font-size: 10px;
            color: #444;
        }

        .divider {
            border-top: 1px solid #bbb;
            margin: 10px 0 14px 0;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th,
        table.data td {
            border: 1px solid #333;
            padding: 6px 7px;
            vertical-align: top;
        }

        table.data th {
            background: #f3b600;
            /* kuning */
            color: #fff;
            text-align: center;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .nowrap {
            white-space: nowrap;
        }

        ul.products {
            margin: 0;
            padding-left: 14px;
        }

        ul.products li {
            margin: 0;
            padding: 0;
        }

        .total-row td {
            font-weight: bold;
            background: #f5f5f5;
        }

        .footer-note {
            margin-top: 10px;
            font-size: 9.5px;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="header">
        <table class="header-table">
            <tr>
                <td style="width: 50%;">
                    <img src="{{ public_path('assets/logo.jpg') }}" style="width:50px" alt="Logo">
                </td>
                <td class="title" style="width: 50%;">
                    <h1>Laporan Bulanan</h1>
                    <div class="meta">
                        Periode: <b>{{ $bulan }}</b><br>
                        Dicetak: {{ now()->format('d-m-Y H:i') }}
                    </div>
                </td>
            </tr>
        </table>

        <div class="divider"></div>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 12%;">Tanggal Transaksi</th>
                <th style="width: 16%;">Kode Transaksi</th>
                <th style="width: 20%;">Customer</th>
                <th>Produk</th>
                <th style="width: 14%;">Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @php $grandTotal = 0; @endphp

            @foreach ($data as $item)
                @php $grandTotal += (int) $item->total_harga; @endphp
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td class="center nowrap">{{ $item->created_at->format('d-m-Y') }}</td>
                    <td class="nowrap"><b>{{ $item->kodeTrx }}</b></td>
                    <td>
                        <b>{{ $item->users->name }}</b><br>
                        <span style="font-size: 10px; color:#555;">{{ $item->users->email }}</span>
                    </td>
                    <td>
                        <ul class="products">
                            @foreach ($item->transaksi_items as $transaksi_item)
                                <li>{{ $transaksi_item->produks->nama }} (x{{ $transaksi_item->jumlah }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="right nowrap">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="5" class="right">Total</td>
                <td class="right nowrap">Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer-note">
        *Laporan ini dibuat otomatis oleh sistem {{ config('app.name') }}.<br>
        *Fee pembayaran tidak terhitung dalam subtotal.
    </div>

</body>

</html>