<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Property, Unit, Tenant, Lease};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        // 5 nieruchomości × 10 lokali
        Property::factory(5)->create()->each(function ($property) {
            Unit::factory(10)->create([
                'property_id' => $property->id,]);
        });

        // 20 lokatorów
        Tenant::factory(20)->create();

        // 30 losowych umów
        // pobieramy istniejące unit-y i tenant-ów, żeby uniknąć factory-nested
        $units   = Unit::all();
        $tenants = Tenant::all();

        Lease::factory(30)->make()->each(function ($lease) use ($units, $tenants) {
            $lease->unit()->associate($units->random());
            $lease->tenant()->associate($tenants->random());
            $lease->save();
        });
    }
}
