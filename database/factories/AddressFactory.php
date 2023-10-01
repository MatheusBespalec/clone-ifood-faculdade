<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->word(),
            "street" => fake()->streetName(),
            "neighborhood" => fake()->word(),
            "number" => fake()->numberBetween(1, 500),
            "complement" => "",
            "reference" => "",
            "city" => fake()->city(),
            "state" => fake()->regionAbbr(),
            "user_id" => User::factory()
        ];
    }
}
