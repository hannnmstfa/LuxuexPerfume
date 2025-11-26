<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route Google OAuth
Route::get('/auth-google-redirect', [OAuthController::class, 'redirectGoogle'])->name('google.redirect');
Route::get('/auth-google-callback', [OAuthController::class, 'callbackGoogle'])->name('google.callback');
Route::get('/home', [GuestController::class, 'home'])->name('guest.home');
Route::get('/', [GuestController::class, 'home'])->name('/');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
