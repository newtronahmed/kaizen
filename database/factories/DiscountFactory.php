<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'amount' => fake()->randomFloat(2, 10, 100),
            'type' => fake()->randomElement(["fixed", "percentage"]),
            'code' => Str::random(8),
            'expiry_date' => now()->addDay(),
        ];
    }
}
