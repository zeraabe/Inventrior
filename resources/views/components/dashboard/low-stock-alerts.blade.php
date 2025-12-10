<div {{ $attributes->merge(['class' => 'bg-white shadow rounded-lg']) }}>
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $title }}
                @if($items->count() > 0)
                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        {{ $items->count() }}
                    </span>
                @endif
            </h3>
            <a href="{{ route('inventory.listing', ['stock_status' => 'low']) }}" 
               class="text-sm text-blue-600 hover:text-blue-500">
                View all
            </a>
        </div>
    </div>
    
    <div class="px-4 py-5 sm:p-6">
        @if($items->isEmpty())
            <div class="text-center py-8">
                <i class="fas fa-check-circle text-green-400 text-4xl mb-4"></i>
                <p class="text-gray-500">No low stock alerts</p>
                <p class="text-sm text-gray-400 mt-1">All inventory levels are satisfactory</p>
            </div>
        @else
            <div class="flow-root">
                <ul class="-mb-8">
                    @foreach($items as $index => $item)
                        @php
                            $priority = $this->getPriority($item);
                            $priorityColor = $this->getPriorityColor($priority);
                            $percentage = $this->getStockPercentage($item);
                        @endphp
                        
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                    <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                @endif
                                
                                <div class="relative flex items-start space-x-3">
                                    <div class="relative">
                                        <div class="h-10 w-10 rounded-full bg-{{ $priorityColor }}-100 flex items-center justify-center ring-8 ring-white">
                                            <i class="fas fa-exclamation text-{{ $priorityColor }}-600"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="min-w-0 flex-1">
                                        <div>
                                            <div class="text-sm">
                                                <a href="{{ route('products.show', $item->product) }}" class="font-medium text-gray-900 hover:underline">
                                                    {{ $item->product->name }}
                                                </a>
                                            </div>
                                            <div class="mt-1 text-sm text-gray-500">
                                                <span class="font-medium">SKU:</span> {{ $item->product->sku }}
                                                @if($item->product->category)
                                                    <span class="mx-2">•</span>
                                                    <span>{{ $item->product->category->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4">
                                            <div class="flex items-center justify-between text-sm">
                                                <div>
                                                    <span class="font-medium">Current:</span>
                                                    <span class="ml-2 text-{{ $priorityColor }}-600 font-bold">
                                                        {{ number_format($item->quantity) }}
                                                    </span>
                                                    <span class="text-gray-500 ml-1">{{ $item->product->unit_of_measure }}</span>
                                                </div>
                                                <div>
                                                    <span class="font-medium">Reorder Point:</span>
                                                    <span class="ml-2">
                                                        {{ number_format($item->reorder_point) }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-2">
                                                <div class="flex items-center">
                                                    <div class="flex-1">
                                                        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200">
                                                            <div style="width: {{ $percentage }}%" 
                                                                 class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-{{ $priorityColor }}-500">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4 text-sm text-gray-500">
                                                        {{ round($percentage) }}% of reorder point
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4 flex space-x-4">
                                            <a href="{{ route('inventory.adjust', $item) }}" 
                                               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-500">
                                                <i class="fas fa-plus-circle mr-1"></i>
                                                Reorder
                                            </a>
                                            <a href="{{ route('inventory.show', $item) }}" 
                                               class="inline-flex items-center text-sm text-gray-600 hover:text-gray-500">
                                                <i class="fas fa-eye mr-1"></i>
                                                View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>