<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quantity' => fake()->numberBetween(0, 30),
            'minimum_stock_level' => fake()->numberBetween(0, 10),
            'maximum_stock_level' => fake() -> numberBetween(10, 29),
            'product_id' => Product::factory(),
        ];
    }
}
