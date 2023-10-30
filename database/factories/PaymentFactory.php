<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'invoice_id' => Invoice::factory(),
            'payment_method' => fake()->randomElement(["cash", "momo","online"]),
            'remaining_balance' => fake()->numberBetween(10, 2000),
            'amount' => fake()->numberBetween(10, 5000),
        ];
    }
}
