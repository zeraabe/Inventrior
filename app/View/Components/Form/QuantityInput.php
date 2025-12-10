<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class QuantityInput extends Component
{
    public $name;
    public $label;
    public $value;
    public $min = 0;
    public $max = null;
    public $step = 0.001;
    public $required = false;
    public $disabled = false;
    public $unit = 'units';
    public $helpText = null;
    public $showButtons = true;
    
    public function __construct(
        $name = 'quantity',
        $label = 'Quantity',
        $value = null,
        $min = 0,
        $max = null,
        $step = 0.001,
        $required = false,
        $disabled = false,
        $unit = 'units',
        $helpText = null,
        $showButtons = true
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->unit = $unit;
        $this->helpText = $helpText;
        $this->showButtons = $showButtons;
    }
    
    public function render()
    {
        return <<<'blade'
<div>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <div class="relative rounded-md shadow-sm">
        @if($showButtons)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-balance-scale text-gray-400"></i>
            </div>
            <input 
                type="number" 
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ $value }}"
                min="{{ $min }}"
                @if($max) max="{{ $max }}" @endif
                step="{{ $step }}"
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                class="block w-full pl-10 pr-12 py-2 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 {{ $disabled ? 'bg-gray-100' : '' }}"
                placeholder="0.000"
            >
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm">{{ $unit }}</span>
            </div>
        @else
            <input 
                type="number" 
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ $value }}"
                min="{{ $min }}"
                @if($max) max="{{ $max }}" @endif
                step="{{ $step }}"
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                class="block w-full px-3 py-2 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 {{ $disabled ? 'bg-gray-100' : '' }}"
                placeholder="0.000"
            >
        @endif
    </div>
    
    @if($helpText)
        <p class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
    @endif
    
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
blade;
    }
}