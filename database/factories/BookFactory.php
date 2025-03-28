<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name,
            'category' => fake()->randomElement(['Fiction', 'Non-Fiction', 'Science', 'History', 'Mystery']),
            'description' => fake()->paragraph,
            'stock' => fake()->numberBetween(1, 10),
        ];
    }
}
