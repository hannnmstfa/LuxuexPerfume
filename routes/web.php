<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProdukController as AdminProduk;
use App\Http\Controllers\Admin\TransaksiController as AdminTrx;
use App\Http\Controllers\Admin\LaporanController as AdmLaporan;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TripayController;
use App\Http\Middleware\Admin;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
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
Route::resource('/analisis', AnalisisController::class)->names('analisis');
Route::match(['POST', 'OPTIONS'], '/n8n/chat', function (Request $request) {
    if ($request->isMethod('options'))
        return response('', 204);
    $webhook = 'https://workflow.hannnmstfa.my.id/webhook/fe325a7b-b0ca-4530-aee1-758a6e90bab2';
    $resp = Http::withBody($request->getContent(), $request->header('Content-Type', 'application/json'))
        ->post($webhook);
    return response($resp->body(), $resp->status())
        ->header('Content-Type', $resp->header('Content-Type', 'application/json'));
})->withoutMiddleware(VerifyCsrfToken::class);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(Admin::class)->group(function () {
        Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
        Route::resource('/admin/produk', AdminProduk::class)->names('admProduk')->except('show');
        Route::put('/admin/produk/{id}/atur-diskon', [AdminProduk::class, 'setDiskon'])->name('admProduk.setDiskon');
        Route::put('/admin/produk/{id}/delete-diskon', [AdminProduk::class, 'delDiskon'])->name('admProduk.delDiskon');
        Route::resource('/admin/transaksi', AdminTrx::class)->names('admTrx');
        Route::put('/admin/transaksi/{kodeTrx}/tracking', [AdminTrx::class, 'tracking'])->name('admTrx.tracking');
        Route::get('/admin/laporan', [AdmLaporan::class, 'index'])->name('admLaporan.index');
        Route::get('/admin/laporan/{bulan}/export-pdf', [AdmLaporan::class, 'pdf'])->name('admLaporan.pdf');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/checkout', CheckoutController::class)->names('checkout')->except('show');
    Route::get('/transaksi/{kodeTrx}/payment', [TransaksiController::class, 'trxPayment'])->name('trx.pay');
    Route::get('/transaksi/{kodeTrx}/payment/downloadQRIS', [TransaksiController::class, 'downloadQris'])->name('downloadQris');
    Route::resource('/transaksi', TransaksiController::class)->names('trx');

});



require __DIR__ . '/auth.php';
