<?php

namespace App\View\Components\Badge;

use Illuminate\View\Component;

class QualityStatus extends Component
{
    public $status;
    public $showIcon = true;
    
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_QUARANTINE = 'quarantine';
    const STATUS_REJECTED = 'rejected';
    const STATUS_HOLD = 'hold';
    const STATUS_PENDING = 'pending';
    
    public function __construct($status, $showIcon = true)
    {
        $this->status = $status;
        $this->showIcon = $showIcon;
    }
    
    public function getColor()
    {
        return match($this->status) {
            self::STATUS_ACCEPTED => 'success',
            self::STATUS_QUARANTINE => 'warning',
            self::STATUS_REJECTED => 'danger',
            self::STATUS_HOLD => 'info',
            self::STATUS_PENDING => 'secondary',
            default => 'secondary'
        };
    }
    
    public function getIcon()
    {
        return match($this->status) {
            self::STATUS_ACCEPTED => 'fas fa-check-circle',
            self::STATUS_QUARANTINE => 'fas fa-shield-alt',
            self::STATUS_REJECTED => 'fas fa-times-circle',
            self::STATUS_HOLD => 'fas fa-pause-circle',
            self::STATUS_PENDING => 'fas fa-clock',
            default => 'fas fa-question-circle'
        };
    }
    
    public function getLabel()
    {
        return match($this->status) {
            self::STATUS_ACCEPTED => 'Accepted',
            self::STATUS_QUARANTINE => 'Quarantine',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_HOLD => 'On Hold',
            self::STATUS_PENDING => 'Pending',
            default => ucfirst($this->status)
        };
    }
    
    public function render()
    {
        return <<<'blade'
<span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-{{ $this->getColor() }}-100 text-{{ $this->getColor() }}-800">
    @if($showIcon)
        <i class="{{ $this->getIcon() }} mr-2"></i>
    @endif
    {{ $this->getLabel() }}
</span>
blade;
    }
}