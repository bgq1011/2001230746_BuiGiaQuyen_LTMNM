<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\CategoryFactory;
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
            'name' => fake()->words(2, true),
            'price' => fake()->numberBetween(10000, 500000),
            'stock' => fake()->numberBetween(0, 100),
            'category_id' => Category::factory(),
        ];
    }
}
