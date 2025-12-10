<?php

namespace App\View\Components\Badge;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ExpiryStatus extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
</div>
blade;
    }
}
