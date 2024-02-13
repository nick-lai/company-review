<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'review' => fake()->realText(200),
            'rating' => fake()->numberBetween(1, 10),
            'created_at' => fake()->dateTimeBetween('-2 years'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at']);
            },
        ];
    }

    public function good()
    {
        return $this->state(fn () => [
            'rating' => fake()->numberBetween(8, 10),
        ]);
    }

    public function neutral()
    {
        return $this->state(fn () => [
            'rating' => fake()->numberBetween(5, 7),
        ]);
    }

    public function bad()
    {
        return $this->state(fn () => [
            'rating' => fake()->numberBetween(1, 4),
        ]);
    }
}
