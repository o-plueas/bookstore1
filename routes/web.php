<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\SellerProfileController;
use App\Http\Controllers\MarketingCampaignController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Route::prefix('seller')->middleware(['auth', 'can:seller'])->group(function () {
//     Route::resource('profile', SellerProfileController::class)->only(['edit', 'update']);
//     Route::resource('marketing', MarketingCampaignController::class)->except(['show']);
// });

Route::middleware(['auth'])->group(function () {
    // Seller routes
    Route::prefix('seller')->group(function () {
        // Route::resource('profile', SellerProfileController::class)->only(['edit', 'update']);
          // To this:
    Route::get('profile/edit', [SellerProfileController::class, 'edit'])->name('seller.profile.edit');
    Route::put('profile', [SellerProfileController::class, 'update'])->name('seller.profile.update');
    




        Route::resource('marketing', MarketingCampaignController::class)->except(['show']);
    });

    // Other authenticated routes
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('order-items', OrderItemController::class)->except(['index', 'create', 'store', 'destroy']);
});
