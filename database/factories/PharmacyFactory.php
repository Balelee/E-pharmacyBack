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
            'pharmacien_id' => User::where('userType', UserType::PHARMACIEN->value)->inRandomOrder()->first()->id
                ?? User::factory()->create(['userType' => UserType::PHARMACIEN->value])->id,
            'pharmacieName' => fake()->name(),
            'adresse' => fake()->address(),
            'phone' => fake()->numerify('########'),

        ];
    }
}
