<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AmenityTest extends TestCase
{
    use RefreshDatabase;

    public function test_name_is_required_when_creating_amenity(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/amenities', []);

        $response->assertSessionHasErrors('name');
    }

    public function test_amenity_is_created_with_valid_name(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/amenities', [
            'name' => 'Parking',
        ]);

        $response->assertRedirect(route('amenities.index', absolute: false));
        $this->assertDatabaseHas('amenities', ['name' => 'Parking']);
    }

    public function test_property_can_have_amenities(): void
    {
        $property = \App\Models\Property::factory()->create();
        $amenity  = \App\Models\Amenity::factory()->create();

        $property->amenities()->attach($amenity);

        $this->assertDatabaseHas('amenity_property', [
            'amenity_id'  => $amenity->id,
            'property_id' => $property->id,
        ]);
    }

    public function test_tenant_can_have_amenities(): void
    {
        $tenant  = \App\Models\Tenant::factory()->create();
        $amenity = \App\Models\Amenity::factory()->create();

        $tenant->amenities()->attach($amenity);

        $this->assertDatabaseHas('amenity_tenant', [
            'amenity_id' => $amenity->id,
            'tenant_id'  => $tenant->id,
        ]);
    }
}
