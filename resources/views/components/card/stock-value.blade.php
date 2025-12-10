<div {{ $attributes->merge(['class' => 'bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl shadow-lg overflow-hidden']) }}>
    <div class="p-8">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">
                    {{ $this->getValuationMethodLabel() }}
                </p>
                <p class="mt-2 text-4xl font-bold text-gray-900">
                    {{ $currency }}{{ number_format($value, 2) }}
                </p>
                
                @if($showChange && $this->previousValue)
                    <div class="mt-2 flex items-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $this->getChangeColor() }}-100 text-{{ $this->getChangeColor() }}-800">
                            <i class="fas {{ $this->getChangeIcon() }} mr-1"></i>
                            {{ $this->getFormattedChange() }}
                        </span>
                        <span class="ml-2 text-sm text-gray-500">
                            from last period
                        </span>
                    </div>
                @endif
            </div>
            
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
            </div>
        </div>
        
        @if($valuationMethod)
            <div class="mt-6">
                <div class="text-xs text-gray-500">
                    Valuation Method: <span class="font-medium">{{ strtoupper($valuationMethod) }}</span>
                </div>
            </div>
        @endif
    </div>
</div>