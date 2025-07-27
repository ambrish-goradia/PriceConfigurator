<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            ['type' => 'size', 'value' => 'small', 'price_addition' => 0],
            ['type' => 'size', 'value' => 'big', 'price_addition' => 20],
            ['type' => 'color', 'value' => 'black', 'price_addition' => 0],
            ['type' => 'color', 'value' => 'white', 'price_addition' => 0],
            ['type' => 'color', 'value' => 'navy', 'price_addition' => 10],
            ['type' => 'color', 'value' => 'cyan', 'price_addition' => 10],
            ['type' => 'color', 'value' => 'red', 'price_addition' => 10],
            ['type' => 'material', 'value' => 'plastic', 'price_addition' => 0],
            ['type' => 'material', 'value' => 'aluminium', 'price_addition' => 20],
        ];

        foreach ($attributes as $attr) {
            Attribute::create($attr);
        }
    }
}
