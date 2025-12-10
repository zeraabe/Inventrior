<?php

namespace App\View\Components\Dashboard;

use App\Models\Inventory;
use Illuminate\View\Component;

class LowStockAlerts extends Component
{
    public $items;
    public $limit = 10;
    public $title = 'Low Stock Alerts';
    public $companyId = null;
    
    public function __construct($items = null, $limit = 10, $title = 'Low Stock Alerts', $companyId = null)
    {
        $this->items = $items;
        $this->limit = $limit;
        $this->title = $title;
        $this->companyId = $companyId;
        
        // Load items if not provided
        if (!$this->items) {
            $this->loadItems();
        }
    }
    
    private function loadItems()
    {
        $query = Inventory::with(['product.category'])
            ->lowStock()
            ->where('quantity', '>', 0); // Only items with some stock
            
        if ($this->companyId) {
            $query->where('company_id', $this->companyId);
        }
        
        $this->items = $query->orderBy('quantity')
            ->limit($this->limit)
            ->get();
    }
    
    public function getStockPercentage($inventory)
    {
        if (!$inventory->reorder_point || $inventory->reorder_point == 0) {
            return 0;
        }
        
        return min(100, ($inventory->quantity / $inventory->reorder_point) * 100);
    }
    
    public function getPriority($inventory)
    {
        $percentage = $this->getStockPercentage($inventory);
        
        if ($percentage <= 10) {
            return 'high';
        } elseif ($percentage <= 30) {
            return 'medium';
        } elseif ($percentage <= 50) {
            return 'low';
        } else {
            return 'info';
        }
    }
    
    public function getPriorityColor($priority)
    {
        return match($priority) {
            'high' => 'red',
            'medium' => 'orange',
            'low' => 'yellow',
            default => 'blue'
        };
    }
    
    public function render()
    {
        return view('components.dashboard.low-stock-alerts');
    }
}