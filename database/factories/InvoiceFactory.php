<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $subtotal_amount = fake()->randomFloat(2, 100, 2000);
        $total_amount = $subtotal_amount + rand(1, 10);
        $payment_due = now()->addMonth();
        return [
            'invoice_number'=>generateIdentifier("INV"),
            'customer_id' => Customer::factory(),
            'total_amount' =>$total_amount,
            'subtotal_amount' => $subtotal_amount,
            'payment_due'=> now()->addMonth(),
            'note' => 'Your payment is due '. $payment_due->format('Y-m-d'),
        ];
    }
}
