<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Badge\InventoryStatus;
use App\View\Components\Badge\ExpiryStatus;
use App\View\Components\Card\InventorySummaryCard;
use App\View\Components\Dashboard\LowStockAlertsCard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    // Register component aliases
    Blade::component('badge.inventory-status', InventoryStatus::class);
    Blade::component('badge.expiry-status', ExpiryStatus::class);
    Blade::component('card.inventory-summary', InventorySummaryCard::class);
    Blade::component('dashboard.low-stock-alerts', LowStockAlertsCard::class);
    
    // Or use anonymous components
    Blade::component('components.badge.*', 'badge');
    }
}
