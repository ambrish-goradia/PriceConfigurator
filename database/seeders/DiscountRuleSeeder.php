<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DiscountRule;

class DiscountRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DiscountRule::create([
            'type' => 'attribute-based',
            'condition' => json_encode(['type' => 'size', 'value' => 'small']),
            'discount_type' => 'percent',
            'amount' => 5,
        ]);

        DiscountRule::create([
            'type' => 'total-based',
            'condition' => json_encode(['threshold' => 200]),
            'discount_type' => 'fixed',
            'amount' => 10,
        ]);

        DiscountRule::create([
            'type' => 'user-type-based',
            'condition' => json_encode(['user_type' => 'company']),
            'discount_type' => 'percent',
            'amount' => 20,
        ]);

        DiscountRule::create([
            'type' => 'attribute-based',
            'condition' => json_encode(['type' => 'color', 'value' => 'black']),
            'discount_type' => 'percent',
            'amount' => 10,
        ]);
    }
}
