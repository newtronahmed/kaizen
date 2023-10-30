<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'vendor_id' => Vendor::factory(),
            'total_amount' => fake()->numberBetween(100, 2000),
            'payment_terms' => fake()->randomElement(["net_30", "pay_on_delivery"]),
            'due_date'=> fake()->dateTimeBetween(now(), '+35 days'),
            'status' => fake()->randomElement(['pending', 'approved', 'in_transit', 'delivered']),
            
        ];
    }
}
