<?php

namespace App\View\Components\Card;

use App\Models\Batch;
use Illuminate\View\Component;

class BatchInfo extends Component
{
    public $batch;
    public $showProduct = true;
    public $showSupplier = true;
    public $showQuality = true;
    public $showActions = true;
    
    public function __construct(
        $batch,
        $showProduct = true,
        $showSupplier = true,
        $showQuality = true,
        $showActions = true
    ) {
        $this->batch = $batch;
        $this->showProduct = $showProduct;
        $this->showSupplier = $showSupplier;
        $this->showQuality = $showQuality;
        $this->showActions = $showActions;
    }
    
    public function render()
    {
        return view('components.card.batch-info');
    }
}