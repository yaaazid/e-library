<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\book>
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
            'title' => fake()->name(),
            'slug' => fake()->slug(),
            'description' => fake()->text(),
            'page_count' => fake()->randomNumber(),
            'author' => fake()->name(),
            'published_year' => fake()->year(),
        ];
    }
}
