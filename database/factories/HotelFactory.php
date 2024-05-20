<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->randomNumber(3),
        ];
    }

    public function country_id(int $id): Factory
    {
        return $this->state([
            'country_id' => $id,
        ]);
    }

    public function city_id(int $id): Factory
    {
        return $this->state([
            'city_id' => $id,
        ]);
    }
}
