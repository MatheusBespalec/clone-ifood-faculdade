<?php

namespace Database\Factories;

use App\Enuns\BrazilStates;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->company(),
            "thumbnail" => fake()->imageUrl(),
            "description" => fake()->text(50),
            "street" => fake()->streetName(),
            "neighborhood" => fake()->streetName(),
            "number" => fake()->buildingNumber(),
            "city" => fake()->city(),
            "zip_code" => fake()->postcode(),
            "state" => fake()->randomElement(BrazilStates::cases()),
        ];
    }
}
