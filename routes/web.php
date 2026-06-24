<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

// =============================================
// PUBLIC ROUTES
// =============================================
Route::get('/', function () {
    $landingStats = [
        'approved' => 0,
        'returned' => 0,
        'users'    => 0,
    ];
    $latestItems = collect();

    try {
        if (Schema::hasTable('items')) {
            $landingStats['approved'] = Item::where('status', 'approved')->count();
            $landingStats['returned'] = Item::where('status', 'returned')->count();
            $latestItems = Item::with('category')
                ->where('status', 'approved')
                ->latest()
                ->take(6)
                ->get();
        }

        if (Schema::hasTable('users')) {
            $landingStats['users'] = User::where('role', 'user')->count();
        }
    } catch (\Throwable) {
        $latestItems = collect();
    }

    return view('public.landing', compact('landingStats', 'latestItems'));
})->name('landing');

Route::get('/items', [ItemController::class, 'publicIndex'])->name('items.public');
Route::get('/items/{item}', [ItemController::class, 'publicShow'])->name('items.show');

// =============================================
// AUTH ROUTES (Breeze)
// =============================================
require __DIR__ . '/auth.php';

// =============================================
// USER ROUTES (login required)
// =============================================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ItemController::class, 'dashboard'])->name('dashboard');

    Route::get('/my-items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/my-items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/my-items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/my-items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/my-items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

    // Profile (dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =============================================
// ADMIN ROUTES
// =============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Manajemen laporan
    Route::get('/items', [AdminController::class, 'items'])->name('items');
    Route::patch('/items/{item}/status', [AdminController::class, 'updateStatus'])->name('items.status');
    Route::delete('/items/{item}', [AdminController::class, 'destroyItem'])->name('items.destroy');

    // Manajemen kategori
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
});
