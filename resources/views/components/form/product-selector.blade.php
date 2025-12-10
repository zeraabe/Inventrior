<div>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <select 
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        class="product-selector block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md {{ $disabled ? 'bg-gray-100' : '' }}"
        data-show-stock="{{ $showStock }}"
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($products as $product)
            <option 
                value="{{ $product['id'] }}"
                {{ $value == $product['id'] ? 'selected' : '' }}
                data-stock="{{ $product['stock'] }}"
                data-available="{{ $product['available'] }}"
                data-unit="{{ $product['unit'] }}"
                data-sku="{{ $product['sku'] }}"
            >
                {{ $product['name'] }} (SKU: {{ $product['sku'] }})
                @if($showStock)
                    - Stock: {{ number_format($product['available']) }} {{ $product['unit'] }}
                @endif
            </option>
        @endforeach
    </select>
    
    <div id="{{ $name }}-info" class="mt-2 text-sm text-gray-500 hidden">
        <div class="grid grid-cols-2 gap-2">
            <div>
                <span class="font-medium">Current Stock:</span>
                <span id="{{ $name }}-stock">0</span>
            </div>
            <div>
                <span class="font-medium">Available:</span>
                <span id="{{ $name }}-available">0</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('{{ $name }}');
        const infoDiv = document.getElementById('{{ $name }}-info');
        const showStock = select.getAttribute('data-show-stock') === 'true';
        
        function updateProductInfo() {
            const selectedOption = select.options[select.selectedIndex];
            const stock = selectedOption.getAttribute('data-stock');
            const available = selectedOption.getAttribute('data-available');
            const unit = selectedOption.getAttribute('data-unit');
            
            if (selectedOption.value && stock !== null) {
                infoDiv.classList.remove('hidden');
                document.getElementById('{{ $name }}-stock').textContent = 
                    parseFloat(stock).toLocaleString() + ' ' + unit;
                document.getElementById('{{ $name }}-available').textContent = 
                    parseFloat(available).toLocaleString() + ' ' + unit;
            } else {
                infoDiv.classList.add('hidden');
            }
        }
        
        select.addEventListener('change', updateProductInfo);
        
        // Initialize if a product is already selected
        updateProductInfo();
        
        // Initialize Select2 if available
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $(select).select2({
                theme: 'bootstrap4',
                width: '100%'
            }).on('change', updateProductInfo);
        }
    });
</script>
@endpush
