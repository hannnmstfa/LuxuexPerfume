<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProdukController As AdminProduk;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

// Route Google OAuth
Route::get('/auth-google-redirect', [OAuthController::class, 'redirectGoogle'])->name('google.redirect');
Route::get('/auth-google-callback', [OAuthController::class, 'callbackGoogle'])->name('google.callback');
Route::get('/', [GuestController::class, 'home'])->name('/');
Route::middleware('auth')->group(function () {
    Route::middleware(Admin::class)->group(function(){
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('/admin/produk', AdminProduk::class)->names('admProduk')->except('show');
        Route::put('/admin/produk/{id}/atur-diskon', [AdminProduk::class, 'setDiskon'])->name('admProduk.setDiskon');
        Route::put('/admin/produk/{id}/delete-diskon', [AdminProduk::class, 'delDiskon'])->name('admProduk.delDiskon');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
