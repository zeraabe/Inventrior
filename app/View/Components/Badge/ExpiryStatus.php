<?php

namespace App\View\Components\Badge;

use Illuminate\View\Component;

class ExpiryStatus extends Component
{
    public $daysToExpiry;
    public $expiryDate;
    public $showIcon = true;
    public $size = 'md';
    
    public function __construct($daysToExpiry = null, $expiryDate = null, $showIcon = true, $size = 'md')
    {
        $this->daysToExpiry = $daysToExpiry;
        $this->expiryDate = $expiryDate;
        $this->showIcon = $showIcon;
        $this->size = $size;
        
        // Calculate days to expiry if expiry date provided
        if ($expiryDate && !$daysToExpiry) {
            $this->daysToExpiry = now()->diffInDays($expiryDate, false);
        }
    }
    
    public function getStatus()
    {
        if ($this->daysToExpiry === null) {
            return 'no_expiry';
        }
        
        if ($this->daysToExpiry < 0) {
            return 'expired';
        } elseif ($this->daysToExpiry <= 7) {
            return 'critical';
        } elseif ($this->daysToExpiry <= 30) {
            return 'warning';
        } elseif ($this->daysToExpiry <= 90) {
            return 'info';
        } else {
            return 'good';
        }
    }
    
    public function getColor()
    {
        return match($this->getStatus()) {
            'expired' => 'danger',
            'critical' => 'danger',
            'warning' => 'warning',
            'info' => 'info',
            'good' => 'success',
            default => 'secondary'
        };
    }
    
    public function getIcon()
    {
        return match($this->getStatus()) {
            'expired', 'critical' => 'fas fa-exclamation-circle',
            'warning' => 'fas fa-exclamation-triangle',
            'info' => 'fas fa-info-circle',
            'good' => 'fas fa-check-circle',
            default => 'fas fa-infinity'
        };
    }
    
    public function getLabel()
    {
        if ($this->daysToExpiry === null) {
            return 'No Expiry';
        }
        
        if ($this->daysToExpiry < 0) {
            return 'Expired';
        } elseif ($this->daysToExpiry === 0) {
            return 'Expires Today';
        } elseif ($this->daysToExpiry == 1) {
            return '1 Day Left';
        } elseif ($this->daysToExpiry < 30) {
            return $this->daysToExpiry . ' Days Left';
        } elseif ($this->daysToExpiry < 365) {
            return floor($this->daysToExpiry / 30) . ' Months Left';
        } else {
            return floor($this->daysToExpiry / 365) . ' Years Left';
        }
    }
    
    public function getSizeClass()
    {
        return match($this->size) {
            'sm' => 'px-2 py-1 text-xs',
            'lg' => 'px-4 py-2 text-lg',
            default => 'px-3 py-1.5'
        };
    }
    
    public function render()
    {
        return view('components.badge.expiry-status');
    }
}