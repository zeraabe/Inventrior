<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Models\StockMovement;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    Gate::authorize('view-any', Inventory::class);
    
    $company = $request->user()->currentCompany;
    
    // Get data for components
    $summary = $this->getInventorySummary($company->id);
    $lowStockItems = Inventory::forCompany($company->id)
        ->with('product')
        ->lowStock()
        ->limit(5)
        ->get();
    
    // Use component-friendly data structure
    return view('inventory.index', [
        'summary' => $summary,
        'lowStockItems' => $lowStockItems,
        // ... other data
    ]);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
    * Get inventory summary for a company
    */
    protected function getInventorySummary($companyId)
    {
    // Total number of products with inventory
    $totalProducts = Inventory::forCompany($companyId)
        ->distinct('product_id')
        ->count('product_id');
    
    // Total inventory value
    $totalValue = Inventory::forCompany($companyId)
        ->with('product')
        ->get()
        ->sum(function ($inventory) {
            return $inventory->quantity * $inventory->product->cost_price;
        });
    
    // Low stock count (less than minimum threshold)
    $lowStockCount = Inventory::forCompany($companyId)
        ->lowStock()
        ->count();
    
    // Out of stock count
    $outOfStockCount = Inventory::forCompany($companyId)
        ->where('quantity', '<=', 0)
        ->count();
    
    // Recent movements (last 7 days)
    $recentMovements = StockMovement::forCompany($companyId)
        ->where('created_at', '>=', now()->subDays(7))
        ->count();
    
    return [
        'total_products' => $totalProducts,
        'total_value' => number_format($totalValue, 2),
        'low_stock_count' => $lowStockCount,
        'out_of_stock_count' => $outOfStockCount,
        'recent_movements' => $recentMovements,
    ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
