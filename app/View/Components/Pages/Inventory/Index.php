<?php

namespace App\View\Components\Pages\Inventory;

use Illuminate\View\Component;

class Index extends Component
{
    public $summary;
    public $lowStockItems;
    public $outOfStockItems;
    public $recentMovements;
    public $totalValue;
    
    public function __construct($summary, $lowStockItems, $outOfStockItems, $recentMovements, $totalValue)
    {
        $this->summary = $summary;
        $this->lowStockItems = $lowStockItems;
        $this->outOfStockItems = $outOfStockItems;
        $this->recentMovements = $recentMovements;
        $this->totalValue = $totalValue;
    }
    
    public function render()
    {
        return view('components.pages.inventory.index');
    }
}