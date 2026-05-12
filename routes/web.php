<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProdukController as AdminProduk;
use App\Http\Controllers\Admin\TransaksiController as AdminTrx;
use App\Http\Controllers\Admin\LaporanController as AdmLaporan;
use App\Http\Controllers\Admin\UserController as AdmUser;
use App\Http\Controllers\Admin\AnalisisController as AdmAnalis;
use App\Http\Controllers\Admin\NoteReturnController;
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
use App\Models\ChatMessage;
use App\Models\ChatSession;
use App\Models\TokoSetting;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

// Route Google OAuth
Route::get('/auth-google-redirect', [OAuthController::class, 'redirectGoogle'])->name('google.redirect');
Route::get('/auth-google-callback', [OAuthController::class, 'callbackGoogle'])->name('google.callback');
Route::get('/', [GuestController::class, 'home'])->name('/');
Route::get('/produk', [GuestController::class, 'produk'])->name('produk');
Route::get('/produk/{slug}', [GuestController::class, 'detailProduk'])->name('produk.detail');
Route::get('/keranjang', [GuestController::class, 'keranjang'])->name('keranjang');
Route::post('/produk/{slug}/store', [GuestController::class, 'produkKeranjang'])->name('produk.keranjang');
Route::post('/transaksi/callback', [TripayController::class, 'trxCallback'])->name('trx.callback')->withoutMiddleware(VerifyCsrfToken::class);
Route::get('/ketentuan-layanan', [GuestController::class, 'ketentuanLayanan'])->name('ketentuan.layanan');
Route::get('/kebijakan-privasi', [GuestController::class, 'kebijakanPrivasi'])->name('kebijakan.privasi');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(Admin::class)->prefix('dashboard')->group(function () {
        Route::get('', [AdminDashboard::class, 'index'])->name('admin.dashboard');
        Route::resource('/produk', AdminProduk::class)->names('admProduk')->except('show');
        Route::put('/produk/{id}/atur-diskon', [AdminProduk::class, 'setDiskon'])->name('admProduk.setDiskon');
        Route::put('/produk/{id}/delete-diskon', [AdminProduk::class, 'delDiskon'])->name('admProduk.delDiskon');
        Route::resource('/transaksi', AdminTrx::class)->names('admTrx');
        Route::resource('/pengembalian/template-catatan', NoteReturnController::class)->names('noteReturn');
        Route::resource('/pengembalian', AdmReturn::class)->names('admReturn');
        Route::put('/transaksi/{kodeTrx}/tracking', [AdminTrx::class, 'tracking'])->name('admTrx.tracking');
        Route::get('/laporan', [AdmLaporan::class, 'index'])->name('admLaporan.index');
        Route::get('/laporan/{bulan}/export-pdf', [AdmLaporan::class, 'pdf'])->name('admLaporan.pdf');
        Route::get('/users/aktif', [AdmUser::class, 'aktif'])->name('users.aktif');
        Route::delete('/users/aktif/{id}/destroy', [AdmUser::class, 'softDelete'])->name('users.destroy');
        Route::put('/users/aktif/{id}/switch-role', [AdmUser::class, 'role'])->name('users.role');
        Route::get('/users/nonaktif', [AdmUser::class, 'nonaktif'])->name('users.nonaktif');
        Route::put('/users/nonaktif/{id}/restore', [AdmUser::class, 'restore'])->name('users.restore');
        Route::delete('/users/nonaktif/{id}/forceDestroy', [AdmUser::class, 'forceDestroy'])->name('users.forceDestroy');
        Route::resource('/analisis', AdmAnalis::class)->names('admAnalis');
        Route::get('/manage-toko', [AdmToko::class, 'index'])->name('admToko.index');
        Route::post('/manage-toko/store-data', [AdmToko::class, 'store'])->name('admToko.store');
    });
    Route::resource('/profile', ProfileController::class)->names('profile');
    Route::resource('/checkout', CheckoutController::class)->names('checkout')->except('show');
    Route::get('/transaksi/{kodeTrx}/payment', [TransaksiController::class, 'trxPayment'])->name('trx.pay');
    Route::get('/transaksi/{kodeTrx}/payment/downloadQRIS', [TransaksiController::class, 'downloadQris'])->name('downloadQris');
    Route::resource('/transaksi', TransaksiController::class)->names('trx');
    Route::resource('/transaksi/{kodeTrx}/pengembalian', PengembalianController::class)->names('pengembalian');
    // Route Handle N8N
    Route::put('/chat/reset/{sessionUser}', function ($sessionUser) {
        if ($sessionUser == session()->getId()) {
            $chatId = $chatId = 'chat_user_' . Auth::user()->id;
            $chatSession = ChatSession::with('chat_messages')->where('chat_id', $chatId)->firstOrFail();
            if ($chatSession->chat_messages->count() == 0) {
                Alert::info('Info !!!', 'Tidak ada chat yang perlu dihapus');
                return back();
            }
            foreach ($chatSession->chat_messages as $chatMessage) {
                $chatMessage->delete();
            }
            $chatSession->session_version = $chatSession->session_version + 1;
            $chatSession->save();
            Alert::success('Sukses', 'Berhasil membersihkan history chat');
            return back();
        } else {
            abort(404, 'Token tidak valid');
        }
    })->name('chat.reset');
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

            $session = ChatSession::with('chat_messages')
                ->where('chat_id', $chatId)
                ->first();
            if (!$session) {
                return response()->json([
                    'status' => 'success',
                    'messages' => null,
                ]);
            }

            $messages = $session->chat_messages;

            return response()->json([
                'status' => 'success',
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

                $session = ChatSession::where('chat_id', $sessionId)->first();

                if (!$session) {
                    $session = ChatSession::create([
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
                } else {
                    $session->update([
                        'customer_name' => $user->name,
                        'customer_email' => $user->email,
                        'customer_phone' => $user->phone,
                        'last_message' => $chatInput,
                        'updated_at' => now(),
                    ]);
                }

                if ($chatInput) {
                    ChatMessage::create([
                        'chat_sessions_id' => $session->id,
                        'sender_type' => 'user',
                        'message' => $chatInput,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $resp = Http::timeout(300)
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
                    ChatMessage::create([
                        'chat_sessions_id' => $session->id,
                        'sender_type' => 'assistant',
                        'message' => $assistantMessage,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $session->update([
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
});



require __DIR__ . '/auth.php';
