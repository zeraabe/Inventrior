<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full {$this->getSizeClass()} font-medium bg-{$this->getColor()}-100 text-{$this->getColor()}-800"]) }}>
    @if($this->showIcon)
        <i class="{{ $this->getIcon() }} mr-2"></i>
    @endif
    {{ $this->getLabel() }}
</span>