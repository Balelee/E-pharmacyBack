<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 10);
        $priceUnitaire = fake()->numberBetween(5, 1000);

        return [
            'order_id' => Order::random() ?: Order::factory(),
            'product_id' => Product::random() ?: Product::factory(),
            'quantity' => $quantity,
            'priceUnitaire' => $priceUnitaire,
        ];
    }
}
