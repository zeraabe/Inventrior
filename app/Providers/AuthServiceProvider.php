<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\StockMovement;
use App\Models\Batch;
use App\Policies\ProductPolicy;
use App\Policies\InventoryPolicy;
use App\Policies\StockMovementPolicy;
use App\Policies\BatchPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Product::class => ProductPolicy::class,
        Inventory::class => InventoryPolicy::class,
        StockMovement::class => StockMovementPolicy::class,
        Batch::class => BatchPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Define roles
        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('is-manager', function ($user) {
            return $user->role === 'manager' || $user->role === 'admin';
        });

        Gate::define('is-staff', function ($user) {
            return in_array($user->role, ['staff', 'manager', 'admin']);
        });
    }
}