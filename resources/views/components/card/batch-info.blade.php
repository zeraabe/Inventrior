<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Batch: {{ $batch->batch_number }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    @if($batch->manufacture_date)
                        Manufactured: {{ $batch->manufacture_date->format('M d, Y') }}
                    @endif
                    @if($batch->expiry_date)
                        • Expires: {{ $batch->expiry_date->format('M d, Y') }}
                    @endif
                </p>
            </div>
            <div>
                <x-badge.expiry-status :daysToExpiry="$batch->days_to_expiry" :showIcon="true" size="lg" />
            </div>
        </div>
    </div>
    
    <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if($showProduct)
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Product Information</h4>
                    <dl class="mt-2 grid grid-cols-1 gap-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Product</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $batch->product->name }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">SKU</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $batch->product->sku }}
                            </dd>
                        </div>
                    </dl>
                </div>
            @endif
            
            <div>
                <h4 class="text-sm font-medium text-gray-500">Batch Details</h4>
                <dl class="mt-2 grid grid-cols-2 gap-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Quantity</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ number_format($batch->quantity) }} {{ $batch->product->unit_of_measure }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Available</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ number_format($batch->available_quantity) }} {{ $batch->product->unit_of_measure }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Unit Cost</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            ${{ number_format($batch->unit_cost, 2) }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Total Value</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            ${{ number_format($batch->total_value, 2) }}
                        </dd>
                    </div>
                </dl>
            </div>
            
            @if($showQuality)
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Quality Status</h4>
                    <div class="mt-2">
                        <x-badge.quality-status :status="$batch->quality_status" :showIcon="true" />
                    </div>
                    @if($batch->certificate_number)
                        <div class="mt-2">
                            <dt class="text-sm font-medium text-gray-500">Certificate</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $batch->certificate_number }}
                            </dd>
                        </div>
                    @endif
                </div>
            @endif
            
            @if($showSupplier && $batch->supplier)
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Supplier</h4>
                    <dl class="mt-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $batch->supplier->name }}
                            </dd>
                        </div>
                        @if($batch->purchaseOrder)
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Purchase Order</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $batch->purchaseOrder->po_number }}
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>
            @endif
        </div>
        
        @if($batch->notes)
            <div class="mt-6">
                <h4 class="text-sm font-medium text-gray-500">Notes</h4>
                <div class="mt-2 p-3 bg-gray-50 rounded-md">
                    <p class="text-sm text-gray-700">{{ $batch->notes }}</p>
                </div>
            </div>
        @endif
        
        @if($showActions)
            <div class="mt-6 flex space-x-3">
                <a href="{{ route('batches.edit', $batch) }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Batch
                </a>
                <a href="#" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-history mr-2"></i>
                    View History
                </a>
            </div>
        @endif
    </div>
</div>