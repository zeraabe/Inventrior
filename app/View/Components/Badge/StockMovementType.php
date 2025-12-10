<?php

namespace App\View\Components\Badge;

use Illuminate\View\Component;

class StockMovementType extends Component
{
    public $type;
    public $showIcon = true;
    public $showArrow = false;
    
    public function __construct($type, $showIcon = true, $showArrow = false)
    {
        $this->type = $type;
        $this->showIcon = $showIcon;
        $this->showArrow = $showArrow;
    }
    
    public function getColor()
    {
        return match($this->type) {
            'receipt', 'return' => 'success',
            'issue', 'write_off', 'consumption' => 'danger',
            'adjustment' => 'warning',
            'transfer' => 'info',
            'production' => 'primary',
            default => 'secondary'
        };
    }
    
    public function getIcon()
    {
        return match($this->type) {
            'receipt' => 'fas fa-arrow-down',
            'issue' => 'fas fa-arrow-up',
            'adjustment' => 'fas fa-adjust',
            'transfer' => 'fas fa-exchange-alt',
            'return' => 'fas fa-undo',
            'write_off' => 'fas fa-trash',
            'production' => 'fas fa-industry',
            'consumption' => 'fas fa-fire',
            default => 'fas fa-exchange-alt'
        };
    }
    
    public function getArrow()
    {
        return match($this->type) {
            'receipt', 'return' => '↑',
            'issue', 'write_off', 'consumption' => '↓',
            default => ''
        };
    }
    
    public function getLabel()
    {
        return match($this->type) {
            'receipt' => 'Receipt',
            'issue' => 'Issue',
            'adjustment' => 'Adjustment',
            'transfer' => 'Transfer',
            'return' => 'Return',
            'write_off' => 'Write-off',
            'production' => 'Production',
            'consumption' => 'Consumption',
            default => ucfirst($this->type)
        };
    }
    
    public function render()
    {
        return view('components.badge.stock-movement-type');
    }
}