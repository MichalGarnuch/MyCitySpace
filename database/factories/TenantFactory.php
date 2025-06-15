<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\Tenant> */
class TenantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name'  => fake()->lastName(),
            'email'      => fake()->unique()->safeEmail(),
            'phone'      => fake()->optional()->e164PhoneNumber(),
        ];
    }
}
