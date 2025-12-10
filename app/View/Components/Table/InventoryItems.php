<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class InventoryItems extends Component
{
    public $items;
    public $showProduct = true;
    public $showCategory = true;
    public $showQuantity = true;
    public $showStatus = true;
    public $showValue = false;
    public $showActions = true;
    public $emptyMessage = 'No inventory items found.';
    public $paginate = false;
    public $striped = true;
    public $hover = true;
    public $compact = false;
    
    public function __construct(
        $items,
        $showProduct = true,
        $showCategory = true,
        $showQuantity = true,
        $showStatus = true,
        $showValue = false,
        $showActions = true,
        $emptyMessage = 'No inventory items found.',
        $paginate = false,
        $striped = true,
        $hover = true,
        $compact = false
    ) {
        $this->items = $items;
        $this->showProduct = $showProduct;
        $this->showCategory = $showCategory;
        $this->showQuantity = $showQuantity;
        $this->showStatus = $showStatus;
        $this->showValue = $showValue;
        $this->showActions = $showActions;
        $this->emptyMessage = $emptyMessage;
        $this->paginate = $paginate;
        $this->striped = $striped;
        $this->hover = $hover;
        $this->compact = $compact;
    }
    
    public function getTableClasses()
    {
        $classes = ['table'];
        
        if ($this->striped) {
            $classes[] = 'table-striped';
        }
        
        if ($this->hover) {
            $classes[] = 'table-hover';
        }
        
        if ($this->compact) {
            $classes[] = 'table-sm';
        }
        
        return implode(' ', $classes);
    }
    
    public function getColumnCount()
    {
        $count = 0;
        if ($this->showProduct) $count++;
        if ($this->showCategory) $count++;
        if ($this->showQuantity) $count++;
        if ($this->showStatus) $count++;
        if ($this->showValue) $count++;
        if ($this->showActions) $count++;
        return $count;
    }
    
    public function render()
    {
        return view('components.table.inventory-items');
    }
}