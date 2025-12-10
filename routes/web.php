<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StockMovementController;

// Authentication routes (already included by Breeze)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected routes with company access middleware
Route::middleware(['auth', 'company.access'])->group(function () {
    // Product routes
    Route::resource('products', ProductController::class);
    Route::get('products/{product}/stock-history', [ProductController::class, 'stockHistory'])
         ->name('products.stock-history');
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])
         ->name('products.toggle-status');
    Route::get('products/export', [ProductController::class, 'export'])
         ->name('products.export');

    // Inventory routes
    Route::get('inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('inventory/listing', [InventoryController::class, 'listing'])->name('inventory.listing');
    Route::get('inventory/{inventory}', [InventoryController::class, 'show'])->name('inventory.show');
    Route::get('inventory/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::put('inventory/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');
    
    // Stock adjustment routes
    Route::get('inventory/create/adjustment', [InventoryController::class, 'createAdjustment'])
         ->name('inventory.create-adjustment');
    Route::get('inventory/{inventory}/adjust', [InventoryController::class, 'createAdjustment'])
         ->name('inventory.adjust');
    Route::post('inventory/adjust-stock', [InventoryController::class, 'adjustStock'])
         ->name('inventory.adjust-stock');
    
    // Report routes
    Route::get('inventory/valuation-report', [InventoryController::class, 'valuationReport'])
         ->name('inventory.valuation-report');
    Route::get('inventory/aging-report', [InventoryController::class, 'agingReport'])
         ->name('inventory.aging-report');
    Route::get('inventory/export', [InventoryController::class, 'export'])
         ->name('inventory.export');

    // Stock movement routes
    Route::resource('stock-movements', StockMovementController::class)->except(['edit', 'update']);
    Route::post('stock-movements/{stock_movement}/approve', [StockMovementController::class, 'approve'])
         ->name('stock-movements.approve');
    Route::get('stock-movements/report', [StockMovementController::class, 'report'])
         ->name('stock-movements.report');
    Route::get('stock-movements/export', [StockMovementController::class, 'export'])
         ->name('stock-movements.export');
});

//require __DIR__.'/auth.php';