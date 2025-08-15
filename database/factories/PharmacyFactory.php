<?php

namespace Database\Factories;

use App\Models\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacy>
 */
class PharmacyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pharmacien_id' => User::where('type', UserType::PHARMACIEN->value)->inRandomOrder()->first()->id
                ?? User::factory()->create(['type' => UserType::PHARMACIEN->value])->id,
            'name' => fake()->name(),
            'adresse' => fake()->address(),
            'phone' => fake()->numerify('########'),

        ];
    }
}
