<?php

namespace Database\Factories;

use App\Models\Unit;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<\App\Models\Lease> */
class LeaseFactory extends Factory
{
    public function definition(): array
    {
        // ramy czasowe: max rok
        $start = fake()->dateTimeBetween('-6 months', '+6 months');
        $end   = (clone $start)->modify('+'.fake()->numberBetween(1, 12).' months');

        return [
            'unit_id'    => Unit::factory(),   // nadpisane w seederze przez ->for($unit)
            'tenant_id'  => Tenant::factory(), // j.w.
            'start_date' => $start->format('Y-m-d'),
            'end_date'   => $end->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'rent' => fake()->numberBetween(1000, 5000),
        ];
    }
}
