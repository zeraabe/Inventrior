<div {{ $attributes->merge(['class' => "bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200"]) }}>
    <div class="p-6">
        <div class="flex items-center">
            @if($icon)
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-{{ $color }}-500 text-white">
                        <i class="fas fa-{{ $icon }} text-lg"></i>
                    </div>
                </div>
            @endif
            <div class="{{ $icon ? 'ml-5' : '' }} w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        {{ $title }}
                    </dt>
                    <dd class="flex items-baseline">
                        <div class="text-2xl font-semibold text-gray-900">
                            {{ $value }}
                        </div>
                        
                        @if($change)
                            <div class="ml-2 flex items-baseline text-sm font-semibold text-{{ $this->getChangeColor() }}-600">
                                <i class="fas {{ $this->getChangeIcon() }} mr-1"></i>
                                {{ $change }}
                            </div>
                        @endif
                    </dd>
                    
                    @if($changeLabel)
                        <dd class="mt-1 text-sm text-gray-500">
                            {{ $changeLabel }}
                        </dd>
                    @endif
                </dl>
            </div>
        </div>
        
        @if($link)
            <div class="mt-6">
                <a href="{{ $link }}" class="inline-flex items-center text-sm font-medium text-{{ $color }}-600 hover:text-{{ $color }}-500">
                    {{ $linkText }}
                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
        @endif
    </div>
</div>