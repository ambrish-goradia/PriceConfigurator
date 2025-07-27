<div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Price Configurator</h2>

    <div class="mb-4">
        <label class="block font-semibold">User Type:</label>
        <select wire:model.defer="userType" wire:change="calculate" class="border p-1 rounded w-full">
            <option value="normal">Normal</option>
            <option value="company">Company</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Products:</label>
        @foreach($products as $product)
            <label class="block">
                <input type="checkbox" wire:model.defer="selectedProducts" wire:change="calculate" value="{{ $product->id }}">
                {{ $product->name }} ({{ number_format($product->base_price, 2) }} KD)
            </label>
        @endforeach
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Attributes:</label>
        @foreach($attributesByType as $type => $options)
            <label class="block mt-2">{{ ucfirst($type) }}:</label>
            <select wire:model.defer="selectedAttributes.{{ $type }}" wire:change="calculate" class="border rounded p-1 w-full">
                <option value="">-- Choose {{ $type }} --</option>
                @foreach($options as $attr)
                    <option value="{{ $attr->id }}">
                        {{ $attr->value }} (+{{ number_format($attr->price_addition, 2) }} KD)
                    </option>
                @endforeach
            </select>
        @endforeach
    </div>

    <div class="mt-6 border-t pt-4">
        <h3 class="text-lg font-bold mb-2">Price Breakdown</h3>
        <ul>
            <li>Base: {{ number_format($base, 2) }} KD</li>
            <li>Attributes: {{ number_format($attributeTotal, 2) }} KD</li>
            <li>Discounts: -{{ number_format($discounts, 2) }} KD</li>
            <li>Total: <strong>{{ number_format($total, 2) }} KD</strong></li>
        </ul>
    </div>
</div>
