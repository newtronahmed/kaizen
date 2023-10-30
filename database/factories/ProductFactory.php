<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(1),
            // 'price' => fake()->randomFloat(2, 1, 200),
            // 'stock_quantity' => fake()->numberBetween(0, 200),
            'brand_id' => Brand::factory(),
            'selling_price' => fake()->randomFloat(2, 10, 200),
            'cost_price' => fake()->randomFloat(2, 10, 100),
            'returnable' => fake()->boolean(),
            'brand_id' => Brand::factory(),
            
        ];
    }
}
