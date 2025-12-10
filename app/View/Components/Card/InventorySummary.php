<?php

namespace App\View\Components\Card;

use Illuminate\View\Component;

class InventorySummary extends Component
{
    public $title;
    public $value;
    public $icon;
    public $color;
    public $change;
    public $changeLabel;
    public $link;
    public $linkText;
    
    public function __construct(
        $title,
        $value,
        $icon = null,
        $color = 'blue',
        $change = null,
        $changeLabel = 'Since last month',
        $link = null,
        $linkText = 'View details'
    ) {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->color = $color;
        $this->change = $change;
        $this->changeLabel = $changeLabel;
        $this->link = $link;
        $this->linkText = $linkText;
    }
    
    public function getChangeColor()
    {
        if (!$this->change) return 'gray';
        
        if (str_starts_with($this->change, '+')) {
            return 'green';
        } elseif (str_starts_with($this->change, '-')) {
            return 'red';
        } else {
            return 'gray';
        }
    }
    
    public function getChangeIcon()
    {
        if (!$this->change) return null;
        
        if (str_starts_with($this->change, '+')) {
            return 'fa-arrow-up';
        } elseif (str_starts_with($this->change, '-')) {
            return 'fa-arrow-down';
        } else {
            return 'fa-minus';
        }
    }
    
    public function render()
    {
        return view('components.card.inventory-summary');
    }
}