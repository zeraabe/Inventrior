<?php

namespace App\View\Components\Badge;

use Illuminate\View\Component;

class InventoryStatus extends Component
{
    public $status;
    public $quantity;
    public $reorderPoint;
    public $maxLevel;
    
    public function __construct($status = null, $quantity = null, $reorderPoint = null, $maxLevel = null)
    {
        $this->status = $status;
        $this->quantity = $quantity;
        $this->reorderPoint = $reorderPoint;
        $this->maxLevel = $maxLevel;
        
        // Auto-determine status if not provided
        if (!$status && $quantity !== null) {
            $this->status = $this->determineStatus($quantity, $reorderPoint, $maxLevel);
        }
    }
    
    private function determineStatus($quantity, $reorderPoint, $maxLevel)
    {
        if ($quantity <= 0) {
            return 'out_of_stock';
        } elseif ($reorderPoint && $quantity <= $reorderPoint) {
            return 'low_stock';
        } elseif ($maxLevel && $quantity > $maxLevel) {
            return 'excess_stock';
        }
        return 'normal';
    }
    
    public function getColor()
    {
        return match($this->status) {
            'out_of_stock' => 'danger',
            'low_stock' => 'warning',
            'excess_stock' => 'info',
            'normal' => 'success',
            default => 'secondary'
        };
    }
    
    public function getLabel()
    {
        return match($this->status) {
            'out_of_stock' => 'Out of Stock',
            'low_stock' => 'Low Stock',
            'excess_stock' => 'Excess Stock',
            'normal' => 'Normal',
            default => ucfirst(str_replace('_', ' ', $this->status))
        };
    }
    
    public function render()
    {
        return view('components.badge.inventory-status');
    }
}