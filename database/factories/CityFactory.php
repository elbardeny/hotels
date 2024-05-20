<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function name(string $name): Factory
    {
        return $this->state([
            'name' => $name,
        ]);
    }

    public function country_id(int $id): Factory
    {
        return $this->state([
            'country_id' => $id,
        ]);
    }
}
