<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\DiscountRule;

class PriceConfigurator extends Component
{
    public array $selectedProducts = [];
    public array $selectedAttributes = [];
    public string $userType = 'normal';

    public float $base = 0;
    public float $attributeTotal = 0;
    public float $discounts = 0;
    public float $total = 0;

    public function mount()
    {
        $this->calculate();
    }

    public function calculate(): void
    {
        $this->base = 0;
        $this->attributeTotal = 0;
        $this->discounts = 0;
        $this->total = 0;

        // Base prices
        foreach ($this->selectedProducts as $id) {
            $product = Product::find($id);
            if ($product) {
                $this->base += $product->base_price;
            }
        }

        // Attribute prices
        foreach ($this->selectedAttributes as $type => $attrId) {
            $attr = Attribute::find($attrId);
            if ($attr) {
                $this->attributeTotal += $attr->price_addition;
            }
        }

        $subtotal = $this->base + $this->attributeTotal;

        // Discounts
        foreach (DiscountRule::all() as $rule) {
            $condition = json_decode($rule->condition, true);

            if ($rule->type === 'attribute-based') {
                foreach ($this->selectedAttributes as $type => $attrId) {
                    $attr = Attribute::find($attrId);
                    if ($attr && $attr->type === $condition['type'] && $attr->value === $condition['value']) {
                        $this->discounts += $this->getDiscount($subtotal, $rule);
                    }
                }
            }

            if ($rule->type === 'total-based' && $subtotal > ($condition['threshold'] ?? INF)) {
                $this->discounts += $this->getDiscount($subtotal, $rule);
            }

            if ($rule->type === 'user-type-based' && $this->userType === ($condition['user_type'] ?? '')) {
                $this->discounts += $this->getDiscount($subtotal, $rule);
            }
        }

        $this->total = max($subtotal - $this->discounts, 0);
    }

    public function getDiscount(float $amount, DiscountRule $rule): float
    {
        return $rule->discount_type === 'percent'
            ? $amount * ($rule->amount / 100)
            : $rule->amount;
    }

    public function render()
    {
        return view('livewire.price-configurator', [
            'products' => Product::all(),
            'attributesByType' => Attribute::all()->groupBy('type'),
        ]);
    }
}