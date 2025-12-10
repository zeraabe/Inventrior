<?php

namespace App\View\Components\Badge;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class StockMovementType extends Component
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
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
</div>
blade;
    }
}
