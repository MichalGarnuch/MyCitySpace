<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\Property> */
class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'    => 'Budynek ' . fake()->randomLetter() . fake()->randomNumber(2),
            'address' => fake()->streetAddress() . ', ' . fake()->city(),
        ];
    }
}
