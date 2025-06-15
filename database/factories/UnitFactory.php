<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Property;

/** @extends Factory<\App\Models\Unit> */
class UnitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'   => 'U-' . strtoupper(Str::random(4)),
            'status' => fake()->randomElement(['free', 'occupied']),
            'property_id' => Property::factory(),
        ];
    }
}
