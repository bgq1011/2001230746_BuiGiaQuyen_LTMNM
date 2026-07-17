<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Bài 04: dữ liệu mẫu cho bảng students
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'age' => fake()->numberBetween(16, 25),
            'gender' => fake()->randomElement(['Nam', 'Nữ']),
            'class_name' => fake()->randomElement(['CNTT K48', 'CNTT K49', 'HTTT K48', 'DTTX K47']),
        ];
    }
}
