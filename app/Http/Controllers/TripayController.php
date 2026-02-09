<?php

namespace App\Http\Controllers;

use App\Mail\Pesanan;
use App\Models\SaldoUser;
use App\Models\TopUp;
use App\Models\Tracking;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class TripayController extends Controller
{
    protected string $url;
    protected string $apiKey;
    protected string $privateKey;
    protected string $merchantCode;
    public function __construct()
    {
        $this->url = config('tripay.url');
        $this->apiKey = config('tripay.api_key');
        $this->privateKey = config('tripay.private_key');
        $this->merchantCode = config('tripay.merchant_code');
    }
    public function getPayment()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => $this->url . '/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $this->apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        curl_close($curl);
        return $response;
    }
    public function detailTrx(string $tripay_ref)
    {
        $payload = ['reference' => $tripay_ref];
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => $this->url . '/transaction/detail?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $this->apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        curl_close($curl);
        return $response;
    }
    public function createTrx($methodCode, $kodeTrx, $amount, $orderItems)
    {
        $data = [
            'method' => $methodCode,
            'merchant_ref' => $kodeTrx,
            'amount' => $amount,
            'customer_name' => Auth::user()->name,
            'customer_email' => Auth::user()->email,
            'customer_phone' => Auth::user()->phone,
            'order_items' => $orderItems,
            'callback_url' => config('app.url') . '/transaksi/callback',
            'return_url' => route('trx.pay', $kodeTrx),
            'expired_time' => (time() + (1 * 60 * 60)),
            'signature' => hash_hmac('sha256', $this->merchantCode . $kodeTrx . $amount, $this->privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => $this->url . '/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $this->apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        curl_close($curl);
        return $response;
    }
    public function trxCallback(Request $request)
    {
        
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $invoiceId = $data->merchant_ref;
        // dd($data);
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            $invoice = Transaksi::with('transaksi_items')
            ->with('transaksi_details')
            ->where('tripay_ref', $tripayReference)->first();

            if (! $invoice) {
                return Response::json([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan: ' . $invoiceId,
                ]);
            }

            switch ($status) {
                case 'UNPAID':
                    $invoice->forceFill([
                        'status_bayar' => 'menunggu pembayaran',
                        'pay_at' => null,
                    ])->save();
                    break;

                case 'PAID':
                    $invoice->update([
                        'status_bayar' => 'berhasil',
                        'pay_at' => now(),
                    ]);
                    foreach ($invoice->transaksi_items as $item) {
                        $produk = $item->produks;
                        $produk->decrement('stok', $item->jumlah);
                    }
                    Tracking::create([
                        'transaksi_id' => $invoice->id,
                        'last_phone' => substr($invoice->transaksi_details->no_penerima, -4),
                    ]);
                    Mail::to('burhanmusthofa1@gmail.com')->queue(new Pesanan($invoice));
                    break;

                case 'EXPIRED':
                    $invoice->update(['status_bayar' => 'kadaluarsa']);
                    break;

                case 'FAILED':
                    $invoice->update(['status_bayar' => 'gagal']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            return Response::json(['success' => true]);
        }
    }
}
