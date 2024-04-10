<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CellFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            "location"=>fake()->numberBetween(10,50),
            "details"=>fake()->numberBetween(10,50),
            "zone_id"=>fake()->numberBetween(1,12),
            "location"=>fake()->streetAddress(),
        ];
    }
}
