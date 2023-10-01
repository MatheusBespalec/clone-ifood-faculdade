<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            "image" => fake()->imageUrl(),
            "description" => fake()->text(40),
            "price" => fake()->randomFloat(2, 0.8, 100),
            "restaurant_id" => Restaurant::factory(),
        ];
    }
}
