<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProdukController as AdminProduk;
use App\Http\Controllers\Admin\TransaksiController as AdminTrx;
use App\Http\Controllers\Admin\LaporanController as AdmLaporan;
use App\Http\Controllers\Admin\UserController as AdmUser;
use App\Http\Controllers\Admin\AnalisisController as AdmAnalis;
use App\Http\Controllers\Admin\TokoController as AdmToko;
use App\Http\Controllers\Admin\PengembalianController as AdmReturn;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TripayController;
use App\Http\Middleware\Admin;
use App\Models\TokoSetting;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

// Route Google OAuth
Route::get('/auth-google-redirect', [OAuthController::class, 'redirectGoogle'])->name('google.redirect');
Route::get('/auth-google-callback', [OAuthController::class, 'callbackGoogle'])->name('google.callback');
Route::get('/', [GuestController::class, 'home'])->name('/');
Route::get('/produk', [GuestController::class, 'produk'])->name('produk');
Route::get('/produk/{produk}', [GuestController::class, 'detailProduk'])->name('produk.detail');
Route::get('/keranjang', [GuestController::class, 'keranjang'])->name('keranjang');
Route::post('/transaksi/callback', [TripayController::class, 'trxCallback'])->name('trx.callback')->withoutMiddleware(VerifyCsrfToken::class);
Route::get('/ketentuan-layanan', [GuestController::class, 'ketentuanLayanan'])->name('ketentuan.layanan');
Route::get('/kebijakan-privasi', [GuestController::class, 'kebijakanPrivasi'])->name('kebijakan.privasi');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(Admin::class)->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
        Route::resource('/dashboard/produk', AdminProduk::class)->names('admProduk')->except('show');
        Route::put('/dashboard/produk/{id}/atur-diskon', [AdminProduk::class, 'setDiskon'])->name('admProduk.setDiskon');
        Route::put('/dashboard/produk/{id}/delete-diskon', [AdminProduk::class, 'delDiskon'])->name('admProduk.delDiskon');
        Route::resource('/dashboard/transaksi', AdminTrx::class)->names('admTrx');
        Route::resource('/dashboard/pengembalian', AdmReturn::class)->names('admReturn');
        Route::put('/dashboard/transaksi/{kodeTrx}/tracking', [AdminTrx::class, 'tracking'])->name('admTrx.tracking');
        Route::get('/dashboard/laporan', [AdmLaporan::class, 'index'])->name('admLaporan.index');
        Route::get('/dashboard/laporan/{bulan}/export-pdf', [AdmLaporan::class, 'pdf'])->name('admLaporan.pdf');
        Route::get('/dashboard/users/aktif', [AdmUser::class, 'aktif'])->name('users.aktif');
        Route::delete('/dashboard/users/aktif/{id}/destroy', [AdmUser::class, 'softDelete'])->name('users.destroy');
        Route::put('/dashboard/users/aktif/{id}/switch-role', [AdmUser::class, 'role'])->name('users.role');
        Route::get('/dashboard/users/nonaktif', [AdmUser::class, 'nonaktif'])->name('users.nonaktif');
        Route::put('/dashboard/users/nonaktif/{id}/restore', [AdmUser::class, 'restore'])->name('users.restore');
        Route::delete('/dashboard/users/nonaktif/{id}/forceDestroy', [AdmUser::class, 'forceDestroy'])->name('users.forceDestroy');
        Route::resource('/dashboard/analisis', AdmAnalis::class)->names('admAnalis');
        Route::get('/dashboard/manage-toko', [AdmToko::class, 'index'])->name('admToko.index');
        Route::post('dashboard/manage-toko/store-data', [AdmToko::class, 'store'])->name('admToko.store');
    });
    Route::resource('/profile', ProfileController::class)->names('profile');
    Route::resource('/checkout', CheckoutController::class)->names('checkout')->except('show');
    Route::get('/transaksi/{kodeTrx}/payment', [TransaksiController::class, 'trxPayment'])->name('trx.pay');
    Route::get('/transaksi/{kodeTrx}/payment/downloadQRIS', [TransaksiController::class, 'downloadQris'])->name('downloadQris');
    Route::resource('/transaksi', TransaksiController::class)->names('trx');
    Route::resource('/transaksi/{kodeTrx}/pengembalian', PengembalianController::class)->names('pengembalian');
});
// Route Handle N8N
Route::withoutMiddleware(VerifyCsrfToken::class)->group(function () {
    Route::get('/chat/history', function (Request $request) {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $chatId = 'chat_user_' . $user->id;

        $session = DB::table('chat_sessions')
            ->where('chat_id', $chatId)
            ->first();

        $messages = DB::table('chat_messages')
            ->where('chat_id', $chatId)
            ->where('session_version', $session->session_version ?? 1)
            ->orderBy('id', 'asc')
            ->get([
                'sender_type',
                'message',
                'created_at',
            ]);

        return response()->json([
            'status' => 'success',
            'chat_id' => $chatId,
            'messages' => $messages,
        ]);
    });
    Route::match(['POST', 'OPTIONS'], '/n8n/chat', function (Request $request) {
        if ($request->isMethod('options')) {
            return response('', 204);
        }

        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
            }

            $payload = json_decode($request->getContent(), true) ?? [];

            $sessionId = 'chat_user_' . $user->id;
            $chatInput = $payload['chatInput'] ?? null;

            $payload['sessionId'] = $sessionId;
            $payload['metadata']['sessionId'] = $sessionId;

            $payload['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'phone' => $user->phone,
            ];

            $webhook = optional(TokoSetting::data())->webhook_chatbot;

            if (!$webhook || !filter_var($webhook, FILTER_VALIDATE_URL)) {
                Log::warning('Webhook chatbot tidak valid', [
                    'webhook' => $webhook,
                    'user_id' => $user->id,
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'Layanan chat sedang tidak tersedia.',
                ], 500);
            }

            DB::beginTransaction();

            $session = DB::table('chat_sessions')->where('chat_id', $sessionId)->first();

            if (!$session) {
                DB::table('chat_sessions')->insert([
                    'chat_id' => $sessionId,
                    'customer_name' => $user->name,
                    'customer_email' => $user->email,
                    'customer_phone' => $user->phone,
                    'user_role' => $user->role ?? 'customer',
                    'session_version' => 1,
                    'last_message' => $chatInput,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $sessionVersion = 1;
            } else {
                $sessionVersion = $session->session_version ?? 1;

                DB::table('chat_sessions')
                    ->where('chat_id', $sessionId)
                    ->update([
                        'customer_name' => $user->name,
                        'customer_email' => $user->email,
                        'customer_phone' => $user->phone,
                        'last_message' => $chatInput,
                        'updated_at' => now(),
                    ]);
            }

            if ($chatInput) {
                DB::table('chat_messages')->insert([
                    'chat_id' => $sessionId,
                    'session_version' => $sessionVersion,
                    'sender_type' => 'user',
                    'message' => $chatInput,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $resp = Http::timeout(30)
                ->acceptJson()
                ->post($webhook, $payload);

            if (!$resp->successful()) {
                DB::rollBack();

                Log::error('N8N webhook gagal', [
                    'status' => $resp->status(),
                    'body' => $resp->body(),
                    'user_id' => $user->id,
                    'webhook' => $webhook,
                    'payload' => $payload,
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'Maaf, layanan chat sedang mengalami gangguan.',
                ], 500);
            }

            $responseBody = $resp->json();
            $assistantMessage = null;

            if (is_array($responseBody)) {
                $assistantMessage =
                    $responseBody['output'] ??
                    $responseBody['text'] ??
                    $responseBody['message'] ??
                    $responseBody['reply_to_user'] ??
                    null;
            }

            if (!$assistantMessage) {
                $assistantMessage = trim($resp->body());
            }

            if ($assistantMessage) {
                DB::table('chat_messages')->insert([
                    'chat_id' => $sessionId,
                    'session_version' => $sessionVersion,
                    'sender_type' => 'assistant',
                    'message' => $assistantMessage,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('chat_sessions')
                    ->where('chat_id', $sessionId)
                    ->update([
                        'last_message' => $assistantMessage,
                        'updated_at' => now(),
                    ]);
            }

            DB::commit();

            return response()->json([
                'output' => $assistantMessage
            ]);

        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Route /n8n/chat exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Maaf, terjadi kesalahan pada server.',
            ], 500);
        }
    });
});



require __DIR__ . '/auth.php';
