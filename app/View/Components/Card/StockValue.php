<?php

namespace App\View\Components\Card;

use Illuminate\View\Component;

class StockValue extends Component
{
    public $value;
    public $previousValue;
    public $currency = '$';
    public $showChange = true;
    public $valuationMethod;
    
    public function __construct($value, $previousValue = null, $currency = '$', $showChange = true, $valuationMethod = null)
    {
        $this->value = $value;
        $this->previousValue = $previousValue;
        $this->currency = $currency;
        $this->showChange = $showChange;
        $this->valuationMethod = $valuationMethod;
    }
    
    public function getChangePercentage()
    {
        if (!$this->previousValue || $this->previousValue == 0) {
            return null;
        }
        
        return (($this->value - $this->previousValue) / $this->previousValue) * 100;
    }
    
    public function getChangeColor()
    {
        $change = $this->getChangePercentage();
        
        if ($change === null) return 'gray';
        
        return $change >= 0 ? 'green' : 'red';
    }
    
    public function getChangeIcon()
    {
        $change = $this->getChangePercentage();
        
        if ($change === null) return 'fa-minus';
        
        return $change >= 0 ? 'fa-arrow-up' : 'fa-arrow-down';
    }
    
    public function getFormattedChange()
    {
        $change = $this->getChangePercentage();
        
        if ($change === null) return 'N/A';
        
        return sprintf('%+.1f%%', $change);
    }
    
    public function getValuationMethodLabel()
    {
        return match($this->valuationMethod) {
            'fifo' => 'FIFO',
            'lifo' => 'LIFO',
            'average_cost' => 'Average Cost',
            'weighted_average' => 'Weighted Average',
            default => 'Total Value'
        };
    }
    
    public function render()
    {
        return view('components.card.stock-value');
    }
}