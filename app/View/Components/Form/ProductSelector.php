<?php

namespace App\View\Components\Form;

use App\Models\Product;
use Illuminate\View\Component;

class ProductSelector extends Component
{
    public $name;
    public $label;
    public $value;
    public $placeholder;
    public $required = false;
    public $disabled = false;
    public $companyId;
    public $showStock = false;
    public $categoryId = null;
    public $onlyActive = true;
    
    public $products;
    
    public function __construct(
        $name = 'product_id',
        $label = 'Product',
        $value = null,
        $placeholder = 'Select a product...',
        $required = false,
        $disabled = false,
        $companyId = null,
        $showStock = false,
        $categoryId = null,
        $onlyActive = true
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->companyId = $companyId;
        $this->showStock = $showStock;
        $this->categoryId = $categoryId;
        $this->onlyActive = $onlyActive;
        
        // Load products
        $this->loadProducts();
    }
    
    private function loadProducts()
    {
        $query = Product::query();
        
        if ($this->companyId) {
            $query->where('company_id', $this->companyId);
        }
        
        if ($this->onlyActive) {
            $query->where('is_active', true);
        }
        
        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }
        
        $this->products = $query->with('inventory')
            ->orderBy('name')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'stock' => $product->inventory ? $product->inventory->quantity : 0,
                    'available' => $product->inventory ? $product->inventory->available_quantity : 0,
                    'unit' => $product->unit_of_measure,
                    'status' => $product->is_active ? 'Active' : 'Inactive'
                ];
            });
    }
    
    public function render()
    {
        return view('components.form.product-selector');
    }
}