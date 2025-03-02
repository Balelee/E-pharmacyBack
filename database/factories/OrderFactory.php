<?php

namespace Database\Factories;

use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::random() ?: User::factory(),
            'pharmacy_id' => Pharmacy::random() ?: Pharmacy::factory(),
            'dateOrder' => fake()->date(),
            'priceTotal' => fake()->numerify('######'),
            'adresLivraison' => fake()->address(),
        ];
    }
}
