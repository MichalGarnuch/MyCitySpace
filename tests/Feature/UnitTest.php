<?php

namespace Tests\Feature;

use App\Models\{Property, Unit, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_unit_is_created_with_valid_data(): void
    {
        $user = User::factory()->create();
        $property = Property::factory()->create();

        $response = $this->actingAs($user)->post(route('properties.units.store', $property, absolute: false), [
            'name' => 'U-01',
            'status' => 'free',
        ]);

        $response->assertRedirect(route('properties.units.index', $property, absolute: false));
        $this->assertDatabaseHas('units', [
            'name' => 'U-01',
            'property_id' => $property->id,
        ]);
    }

    public function test_unit_name_is_required(): void
    {
        $user = User::factory()->create();
        $property = Property::factory()->create();

        $response = $this->actingAs($user)->post(route('properties.units.store', $property, absolute: false), [
            // brak nazwy
            'status' => 'free',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_unit_can_be_updated(): void
    {
        $user = User::factory()->create();
        $unit = Unit::factory()->create();
        $property = $unit->property;

        $response = $this->actingAs($user)->put(route('properties.units.update', [$property, $unit], absolute: false), [
            'name' => 'U-02',
            'status' => 'occupied',
        ]);

        $response->assertRedirect(route('properties.units.index', $property, absolute: false));
        $unit->refresh();
        $this->assertSame('U-02', $unit->name);
    }

    public function test_unit_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $unit = Unit::factory()->create();
        $property = $unit->property;

        $response = $this->actingAs($user)->delete(route('properties.units.destroy', [$property, $unit], absolute: false));

        $response->assertRedirect(route('properties.units.index', $property, absolute: false));
        $this->assertDatabaseMissing('units', [
            'id' => $unit->id,
        ]);
    }
}
