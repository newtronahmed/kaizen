<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email_address' => fake()->unique()->safeEmail,
            'name' => fake()->name,
            'phone' => fake()->phoneNumber,
            'company_name' => fake()->optional()->company,
            'city' => fake()->city(),
            'country' => fake()->country(),
            'postcode' => fake()->postcode(),
            'address' => fake()->address(),
        ];
    }
}
