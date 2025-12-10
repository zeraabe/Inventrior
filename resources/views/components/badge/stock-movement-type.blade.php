<span {{ $attributes->merge(['class' => "inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-{$this->getColor()}-100 text-{$this->getColor()}-800"]) }}>
    @if($this->showIcon)
        <i class="{{ $this->getIcon() }} mr-2"></i>
    @endif
    {{ $this->getLabel() }}
    @if($this->showArrow && $this->getArrow())
        <span class="ml-2 font-bold">{{ $this->getArrow() }}</span>
    @endif
</span>