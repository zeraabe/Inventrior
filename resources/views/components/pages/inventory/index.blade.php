<div>
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <x-card.inventory-summary 
            title="Total Items"
            value="{{ number_format($summary['total_items']) }}"
            icon="boxes"
            color="primary" />
            
        <x-card.inventory-summary 
            title="Total Quantity"
            value="{{ number_format($summary['total_quantity']) }}"
            icon="cubes"
            color="success" />
            
        <x-card.inventory-summary 
            title="Low Stock Items"
            value="{{ $summary['low_stock_items'] }}"
            icon="exclamation-triangle"
            color="warning" />
            
        <x-card.inventory-summary 
            title="Out of Stock"
            value="{{ $summary['out_of_stock_items'] }}"
            icon="times-circle"
            color="danger" />
    </div>
    
    <!-- Stock Value Card -->
    <x-card.stock-value :value="$totalValue" class="mb-6" />
    
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('inventory.create-adjustment') }}" 
               class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center transition">
                <i class="fas fa-plus-circle fa-2x mb-2"></i>
                <div class="font-semibold">Adjust Stock</div>
            </a>
            <!-- Add other action buttons -->
        </div>
    </div>
    
    <!-- Low Stock & Recent Movements -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-dashboard.low-stock-alerts-card :items="$lowStockItems" />
        <x-dashboard.recent-movements-card :movements="$recentMovements" />
    </div>

    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
</div>