<div class="overflow-x-auto">
    <table class="{{ $this->getTableClasses() }}">
        <thead class="bg-gray-50">
            <tr>
                @if($showProduct)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Product
                    </th>
                @endif
                @if($showCategory)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Category
                    </th>
                @endif
                @if($showQuantity)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantity
                    </th>
                @endif
                @if($showStatus)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                @endif
                @if($showValue)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Value
                    </th>
                @endif
                @if($showActions)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($items as $item)
                <tr class="{{ $hover ? 'hover:bg-gray-50' : '' }}">
                    @if($showProduct)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($item->product->image_path)
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover" 
                                             src="{{ Storage::url($item->product->image_path) }}" 
                                             alt="{{ $item->product->name }}">
                                    </div>
                                @endif
                                <div class="{{ $item->product->image_path ? 'ml-4' : '' }}">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $item->product->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        SKU: {{ $item->product->sku }}
                                    </div>
                                </div>
                            </div>
                        </td>
                    @endif
                    
                    @if($showCategory)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $item->product->category->name ?? 'N/A' }}
                            </div>
                        </td>
                    @endif
                    
                    @if($showQuantity)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 font-medium">
                                {{ number_format($item->quantity) }}
                            </div>
                            <div class="text-xs text-gray-500">
                                Available: {{ number_format($item->available_quantity) }}
                                @if($item->reserved_quantity > 0)
                                    <span class="text-orange-500 ml-2">
                                        (Reserved: {{ number_format($item->reserved_quantity) }})
                                    </span>
                                @endif
                            </div>
                        </td>
                    @endif
                    
                    @if($showStatus)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-badge.inventory-status 
                                :status="$item->stock_status"
                                :quantity="$item->quantity"
                                :reorderPoint="$item->reorder_point"
                                :maxLevel="$item->maximum_stock_level" />
                        </td>
                    @endif
                    
                    @if($showValue)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${{ number_format($item->total_value, 2) }}
                        </td>
                    @endif
                    
                    @if($showActions)
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('inventory.show', $item) }}" 
                                   class="text-blue-600 hover:text-blue-900"
                                   title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('inventory.adjust', $item) }}" 
                                   class="text-green-600 hover:text-green-900"
                                   title="Adjust Stock">
                                    <i class="fas fa-adjust"></i>
                                </a>
                                <a href="{{ route('inventory.edit', $item) }}" 
                                   class="text-yellow-600 hover:text-yellow-900"
                                   title="Edit Settings">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $this->getColumnCount() }}" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-box-open text-3xl mb-3 text-gray-300"></i>
                        <p>{{ $emptyMessage }}</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($paginate && $items instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $items->links() }}
        </div>
    @endif
</div>